<?php

HTML::macro('extendedStyle', function($url, $attributes = array(), $secure = null) {
    $prefix = $_ENV['ROUTES_PREFIX'] == '' ? '' : $_ENV['ROUTES_PREFIX'] . '/';
    return HTML::style($prefix . $url, $attributes, $secure);
});

HTML::macro('extendedScript', function($url, $attributes = array(), $secure = null) {
    $prefix = $_ENV['ROUTES_PREFIX'] == '' ? '' : $_ENV['ROUTES_PREFIX'] . '/';
    return HTML::script($prefix . $url, $attributes, $secure);
});

HTML::macro('extendedImage', function($url, $alt = null, $attributes = array(), $secure = null) {
    $prefix = $_ENV['ROUTES_PREFIX'] == '' ? '' : $_ENV['ROUTES_PREFIX'] . '/';
    return HTML::image($prefix . $url, $alt, $attributes, $secure);
});

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
                $recenzenti = User::whereIn('id', UserRole::where('rank_id', User::REVIEWER)->select('user_id')->get()->toArray())->orderBy('name', 'ASC')->get();
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

HTML::macro('profile', function($id = null, $size = 4) {
    $user = User::find($id);
    return '
        <div class="col-md-' . $size . ' col-md-height col-middle">
            <div class="thumbnail clearfix" type="clanok">
                <div class="row">
                    <div class="col-md-12">
                        <h3>' . link_to_action('MenuController@getProfile', $user->name, [$user->id], array('class' => 'text-muted')) . '</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <p><i class="fa fa-birthday-cake" style="width: 14px"></i> <span class="text">' . $user->getFormattedBirth() . '</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><span class="glyphicon glyphicon-envelope"></span> <span class="text">' . $user->email . '</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><i class="fa fa-home" style="width: 14px"></i> ' . $user->city . '</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><i class="fa fa-graduation-cap" style="width: 14px"></i> <span class="text">' . $user->school . '</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
});

HTML::macro('profileGrid', function($profiles, $width = 3, $size = 4) {
    $_user = [];
    foreach ($profiles as $profile) {
        $_user[] = HTML::profile($profile->id, $size);
    }
    $result = "<div class=\"row container-md-height col-md-12\">";
    $result .= implode("</div><div class=\"row container-md-height col-md-12\">", array_map(function($i) {
                return implode("", $i);
            }, array_chunk($_user, $width)));
    return $result . "</div>";
});
