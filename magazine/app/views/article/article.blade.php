@extends('layouts.two_one_layout')

@section('right')
<ul class="nav nav-tabs nav-stacked">
    <li>{{ HTML::linkAction('ArticleController@newArticle', Lang::get('article.new_article'))}}</li>
    <li><a href="{{ action('ArticleController@draft') }}">{{ Lang::choice('article.draft', Auth::User()->articles()->draft()->get()->count()) }} <span class="badge">{{Auth::User()->articles()->draft()->get()->count()}}</span></a></li>
    <li>{{ HTML::linkAction('ArticleController@sent', Lang::get('article.sent'))}}</li>
    <li>{{ HTML::linkAction('ArticleController@accepted', Lang::get('article.accepted'))}}</li>
    <li>{{ HTML::linkAction('ArticleController@unapproved', Lang::get('article.unapproved'))}}</li>
    @if(Auth::user()->hasRank(User::ADMIN) || Auth::user()->hasRank(User::REDACTION))
    <li>{{ HTML::linkAction('ArticleController@articleManagement', Lang::get('article.article_management'))}}</li>
    @endif
</ul>
@stop