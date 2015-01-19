@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <p class="text-justify">{{ File::get('kontakt.txt') }}</p>
        </div>
    </div>
</div>
@stop

@section('footer')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="background-color: #00A2E8">
            <p class="text-center" style="font-size: 14px; text-transform: uppercase; color: white; margin: 10px">Online Geogebra magazín Univerzity Komenského bol vytvorený ako projekt na predmet Tvorba informačných systémov na FMFI UK v akademickom roku 2014/2015 študentmi: Patrícia Šišková, Jozef Dúc, Michal Hoľa, Marián Opial </p>
        </div>
    </div>
</div>
@stop