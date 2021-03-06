@extends('layouts.two_one_layout')

@section('right')
<ul class="nav nav-tabs nav-stacked">
    <li>{{ HTML::linkAction('ArticleController@newArticle', Lang::get('article.new_article'))}}</li>
    <li><a href="{{ action('ArticleController@draft') }}">{{ Lang::choice('article.draft', Auth::User()->articles()->draft()->get()->count()) }} <span class="badge">{{Auth::User()->articles()->draft()->get()->count()}}</span></a></li>
    <li>{{ HTML::linkAction('ArticleController@sent', Lang::get('article.sent'))}}</li>
    <li>{{ HTML::linkAction('ArticleController@published', Lang::get('article.published'))}}</li>
    @if(Auth::user()->hasRank(User::REVIEWER))
    <li>{{ HTML::linkAction('ArticleController@forReview', Lang::get('article.for_review'))}}</li>
    @endif
    @if(Auth::user()->hasRank(User::ADMIN) || Auth::user()->hasRank(User::REDACTION))
    <li>{{ HTML::linkAction('ArticleController@articleManagement', Lang::get('article.article_management'))}}</li>
    @endif
</ul>
@stop