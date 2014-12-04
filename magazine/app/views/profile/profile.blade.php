@extends('layouts.six_three_layout')

@section('js')
{{HTML::style('css/font-awesome.min.css')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}

img{
margin-right: 9px !important;
}
@stop

@if($canEdit)
@section('ready_js')
$('#profile .fa, #profile .glyphicon').parent().mouseenter(function(){
$(this).append(' <span class="glyphicon glyphicon-pencil text-muted"></span>');
});

$('#profile .fa,#profile .glyphicon').parent().mouseleave(function(){
$('.glyphicon-pencil', this).remove();
});
@stop
@endif

@section('left')
<div class="col-md-12" id="profile">
    <div class="thumbnail" type="clanok">
        <div class="row">
            <div class="col-md-3">
                {{ HTML::image('img/apache_pb.png', 'alt', array('class' => 'img-rounded img-responsive')) }}
            </div>
            <div class="col-md-9">
                <p><span style="width: 14px"></span><h3>{{{ $user->name }}}</h3></p>
                <p><span class="glyphicon glyphicon-briefcase"></span> {{{ User_group::find($user->roles()->orderBy('rank_id', 'ASC')->first()->rank_id)->description }}}</p>
                <p><i class="fa fa-birthday-cake" style="width: 14px"></i> {{{ $user->getFormattedBirth() }}}</p>
                <p><i class="fa fa-home" style="width: 14px"></i> {{{ $user->city }}}</p>
                <p><i class="fa fa-graduation-cap" style="width: 14px"></i> {{{ $user->school }}}</p>
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-envelope"></span> {{{ $user->email }}}</p>
                    </div>
                    @if($user->google)
                    <div class="col-md-6">
                        <p style="color: #DD4B39"><i class="fa fa-google-plus" style="width: 14px"></i> {{{ $user->google }}}</p>
                    </div>
                    @endif
                    @if($user->facebook)
                    <div class="col-md-6">
                        <p style="color: #3B5998"><i class="fa fa-facebook" style="width: 14px"></i> <a href="https://www.facebook.com/jozef.duc1">{{{ $user->facebook }}}</a></p>
                    </div>
                    @endif
                    @if($user->twitter)
                    <div class="col-md-6">
                        <p style="color: #55ACEE"><i class="fa fa-twitter" style="width: 14px"></i><i class="fa fa-at"></i>{{{ $user->twitter }}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if($user->about)
        <div class="row">
            <div class="col-md-12">
                <p class="text-justify"><span class="glyphicon glyphicon-search"></span> {{{ $user->about }}}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@stop

@section('right')
<div class="jumbotron">
    @if($articles->isEmpty())
    <h2>Online geogebra časopis</h2>
    <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean et est a dui semper facilisis. Pellentesque placerat elit a nunc. Nullam tortor odio, rutrum quis, egestas ut, posuere sed, felis. Vestibulum placerat feugiat nisl. Suspendisse lacinia, odio non feugiat vestibulum, sem erat blandit metus, ac nonummy magna odio pharetra felis. Vivamus vehicula velit non metus faucibus auctor. Nam sed augue. Donec orci. Cras eget diam et dolor dapibus sollicitudin. In lacinia, tellus vitae laoreet ultrices, lectus ligula dictum dui, eget condimentum velit</p>
    @else 
    <h2>{{ Lang::get('article.author_articles') }}</h2>
    @foreach($articles as $article)
        {{ link_to_action('ArticleController@detail', $article->title, [$article->id]) }}
        <br>
    @endforeach
    @endif
</div>
@stop