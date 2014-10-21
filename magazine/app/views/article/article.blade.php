@extends('layouts.two_one_layout')

@section('right')
<ul class="nav nav-tabs nav-stacked">
    <li>{{ HTML::link('/article/new', 'Nový článok')}}</li>
    <li>{{ HTML::link('/article/koncept', 'Koncepty')}}</li>
    <li>{{ HTML::link('/article/accepted', 'Schválené')}}</li>
    <li>{{ HTML::link('/article/unapproved', 'Neschválené')}}</li>
    <li>{{ HTML::link('/article/detail', 'Článok test')}}</li>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Profil <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>{{ HTML::link('/article', 'Nový článok')}}</li>
            <li class="divider"></li>
            <li><a href="#">Upraviť profil</a></li>
        </ul>
    </li>
    <li><a href="#">Registrácia</a></li>-->
</ul>
@stop