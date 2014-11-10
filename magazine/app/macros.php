<?php

HTML::macro('article', function($id = null, $size = 4, $draft = false) {
    $article = Article::find($id);
    $user = User::find($article->user_id);
    //{{ HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded pull-left')) }}
    $link = link_to_action($draft ? 'ArticleController@newArticle' : 'ArticleController@detail', $article->title, [$id]);
    return '
        <div class="col-md-' . $size . ' col-md-height col-middle">
            <div class="thumbnail clearfix" type="clanok"><h3>' . $link . '</h3>
                <p class="text-muted"><span class="glyphicon glyphicon-user"></span>&nbsp;' . link_to_action('MenuController@getProfile', $user->name, [$user->id], array('class' => 'text-muted')) . '</p>
                <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>&nbsp;' . $article->created_at . '</p>
                <p class="text-muted">
                    <span class="glyphicon glyphicon-tags"></span>
                    &nbsp;<a class="label label-primary">kosinus</a>
                    <a class="label label-primary">kosinus</a>
                    <a class="label label-primary">kosinus</a>
                    <a class="label label-primary">sinus</a>
                    <a class="label label-primary">Tag3</a>
                    <a class="label label-primary">Tag4</a>
                    <a class="label label-primary">Pytagorova veta</a>
                    <a class="label label-primary">Tag5</a>
                </p>
                <p>' . $article->abstract . '</p>
            </div>
        </div>';
});
