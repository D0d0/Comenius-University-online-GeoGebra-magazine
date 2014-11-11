<?php

HTML::macro('tags', function($id) {
    $tagsResult = '<span class="glyphicon glyphicon-tags"></span>&nbsp; ';
    foreach (Article::find($id)->tags as $value) {
        $tagsResult .='<a class="label label-primary">' . $value->tagDescription->name . '</a> ';
    }
    return $tagsResult;
});

HTML::macro('article', function($id = null, $size = 4, $draft = false) {
    $article = Article::find($id);
    $link = link_to_action($draft ? 'ArticleController@newArticle' : 'ArticleController@detail', $article->title, [$id]);
    return '
        <div class="col-md-' . $size . ' col-md-height col-middle">
            <div class="thumbnail clearfix" type="clanok">
                ' . HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) . '
                <h3>' . $link . '</h3>
                <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;' . link_to_action('MenuController@getProfile', $article->user->name, [$article->user->id], array('class' => 'text-muted')) . '</p>
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;' . $article->getFormattedCreatedAt() . '</p>
                <p class="text-muted">' . HTML::tags($id) . '</p>
                <p>' . $article->abstract . '</p>
            </div>
        </div>';
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
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;' . $article->getFormattedCreatedAt() . '</p>
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
