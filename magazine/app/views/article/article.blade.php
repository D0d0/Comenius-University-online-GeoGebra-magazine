@extends('layouts.two_one_layout')

@section('right')
<ul class="nav nav-tabs nav-stacked">
    <li>{{ HTML::link('/article/new', 'Nový článok')}}</li>
    <li><a href="{{ url('/article/koncept') }}">Koncepty <span class="badge">2</span></a></li>
    <li>{{ HTML::link('/article/accepted', 'Schválené')}}</li>
    <li>{{ HTML::link('/article/unapproved', 'Neschválené')}}</li>
    <li>{{ HTML::link('/article/detail', 'Článok test')}}</li>
 </ul>
@stop