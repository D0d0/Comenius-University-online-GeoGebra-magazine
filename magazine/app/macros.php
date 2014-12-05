<?php

HTML::macro('tags', function($id) {
    $tagsResult = '<span class="glyphicon glyphicon-tags"></span>&nbsp; ';
    foreach (Article::find($id)->tags as $value) {
        $tagsResult .='<a class="label label-primary help-block" href="' . action('HomeController@findTag', [$value->id_tag]) . '">' . $value->tagDescription->name . '</a> ';
    }
    return $tagsResult;
});

HTML::macro('article', function($id = null, $size = 4, $draft = false, $management = false) {
    $article = Article::find($id);
    $link = link_to_action($draft ? 'ArticleController@newArticle' : 'ArticleController@detail', $article->title, [$id]);
    $append = '';
    if ($management) {
        $up = '';
        $down = '';
        //pokial to je odoslane
        if ($article->state == Article::SENT) {
            //odoslana bez priradeneho recenzenta
            if (!$review = $article->review) {
                $recenzenti = User::whereIn('id', UserRole::where('rank_id', '=', User::ADMIN)->orWhere('rank_id', User::REVIEWER)->select('user_id')->get()->toArray())->orderBy('name', 'ASC')->get();
                $options = '';
                foreach ($recenzenti as $recenzent) {
                    $options.='<option value=' . $recenzent->id . '>' . $recenzent->name . '</option>';
                }
                $up = '
                    <label for="inputEmail3" class="col-md-4 control-label">' . Lang::get('article.choose_reviewer') . '</label>
                    <div class="col-md-6">
                        <select class="form-control reviewer_id">
                            ' . $options . '
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="button" class="btn btn-default save_reviewer" value="' . Lang::get('article.save') . '">
                    </div>';
            } else {
                //odoslana s priradenym recenzentom
                $up = '
                    <div class="col-md-4 col-md-offset-2 text-right">
                        <strong>' . Lang::get('article.reviewer_name') . '</strong>
                    </div>
                    <div class="col-md-6">
                        <strong>' . $review->reviewer->name . '</strong>
                    </div>';
            }
        }
        if ($article->state == Article::ACCEPTED || $article->state == Article::UNAPROVED) {
            try {
                $meno = $article->review->reviewer->name;
            } catch (Exception $e) {
                $meno = '';
            }
            $up = '
                    <div class="col-md-4 col-md-offset-2 text-right">
                        <strong>' . Lang::get('article.recommendation') . '</strong>
                    </div>
                    <div class="col-md-6">
                        <strong>' . Lang::get($article->state == Article::ACCEPTED ? 'article.accepted' : 'article.unapproved') . '</strong>
                    </div>
                    <div class="col-md-3 col-md-offset-3 text-right">
                        <strong>' . Lang::get('article.reviewer') . '</strong>
                    </div>
                    <div class="col-md-6">
                        <strong>' . $meno . '</strong>
                    </div>';
            $down = '
                    <div class="col-md-3 col-md-offset-3">
                        <button type="button" class="btn btn-default btn-md publish">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ' . Lang::get('article.publish') . '
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-default btn-md non_publish">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ' . Lang::get('article.not_publish') . '
                        </button>
                    </div>';
        }
        $down = $down ? '<div class="form-group">' . $down . '</div>' : '';
        $append = '
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal help-block" role="form" id="' . $id . '">
                                <div class="form-group">
                                    ' . $up . '
                                </div>
                                ' . $down . '
                            </form>
                        </div>
                    </div>';
    }
    return '
        <div class="col-md-' . $size . ' col-md-height col-middle">
            <div class="thumbnail clearfix" type="clanok">
                <div class="row">
                    <div class="col-md-12">
                        ' . HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) . '
                        <h3>' . $link . '</h3>
                        <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;' . link_to_action('MenuController@getProfile', $article->user->name, [$article->user->id], array('class' => 'text-muted')) . '</p>
                        <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;' . $article->getFormattedUdatedAt() . '</p>
                        <p class="text-muted">' . HTML::tags($id) . '</p>
                        <p>' . $article->abstract . '</p>
                    </div>
                </div>
                ' . $append . '
            </div>
        </div>';
});

HTML::macro('articleGrid', function($articles, $width = 3, $size = 4, $draft = false, $management = false) {
    $_articles = [];
    foreach ($articles as $article) {
        $_articles[] = HTML::article($article->id, $size, $draft, $management);
    }
    $result = "<div class=\"row container-md-height col-md-12\">";
    $result .= implode("</div><div class=\"row container-md-height col-md-12\">", array_map(function($i) {
                return implode("", $i);
            }, array_chunk($_articles, $width)));
    return $result . "</div>";
});


HTML::macro('articleWithReview', function($id = null, $size = 4, $draft = false) {
    $article = Article::find($id);
    $link = link_to_action($draft ? 'ArticleController@newArticle' : 'ArticleController@detail', $article->title, [$id]);
    return '
        <div class="col-md-' . $size . ' col-md-height col-middle">
            <div class="thumbnail clearfix" type="clanok">
                ' . HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) . '
                <h3>' . $link . '</h3>
                <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;' . link_to_action('MenuController@getProfile', $article->user->name, [$article->user->id], array('class' => 'text-muted')) . '</p>
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;' . $article->getFormattedUdatedAt() . '</p>
                <p class="text-muted">' . HTML::tags($id) . '</p>
                <p>' . $article->abstract . '</p>
                <p>
                    <label for="addReviewer" class="col-sm-4 control-label">TODOPriradiť recenzenta</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="addReviewer">
                    </div>
                </p>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary">TODOPublikovať</button>
                    <button type="button" class="btn btn-default">TODONepublikovať</button>
                </div>
            </div>
        </div>';
});
