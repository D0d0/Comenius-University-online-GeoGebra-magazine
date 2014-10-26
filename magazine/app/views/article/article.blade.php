@extends('layouts.two_one_layout')

@section('right')
<ul class="nav nav-tabs nav-stacked">
    <li>{{ HTML::link('/article/new', Lang::get('article.new_article'))}}</li>
    <li><a href="{{ url('/article/draft') }}">{{ Lang::choice('article.draft', 5 /*pocet konceptov*/) }} <span class="badge">6</span></a></li>
    <li>{{ HTML::link('/article/accepted', Lang::get('article.accepted'))}}</li>
    <li>{{ HTML::link('/article/unapproved', Lang::get('article.unapproved'))}}</li>
    <li>{{ HTML::link('/article/article_management', Lang::get('article.article_management'))}}</li>
    <li>{{ HTML::link('/article/detail', 'Článok test')}}</li>
 </ul>
@stop