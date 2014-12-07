@extends('layouts.six_three_layout')

@section('js')
{{HTML::extendedStyle('css/font-awesome.min.css')}}
@stop

@section('style')
[type=clanok]{
padding: 9px;
}
@stop

@section('ready_js')
$('.save').on('click', function(){
    $('.save').attr('disabled', 'disabled').html('{{ Lang::get('article.saving') }}');
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '{{ action('UserController@updateProfile') }}',
        data: {
            'email' : $('#email').val(),
            'city' : $('#city').val(),
            'school' : $('#school').val(),
            'date' : $('#date').val(),
        },
        success: function(answer){
            if(answer['result']){
                $('.save').removeAttr('disabled').html('{{ Lang::get('article.saved') }}');
            }else{
                $('.save').removeAttr('disabled').html('Chyba pri ukladaní užívateľa!');
            }
        },
        error: function(){
            $('.save').removeAttr('disabled').html('Chyba pri ukladaní užívateľa!');
        }
    });
    return false;
});
@stop

@section('left')
<div class="col-md-12" id="profile">
    <div class="thumbnail" type="clanok">
        <div class="row">
            <div class="col-md-12">
                <h3>{{{ $user->name }}}</h3>
                @if($canEdit)
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="date" class="col-md-2 control-label">Dátum narodenia</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="date" placeholder="Dátum narodenia" value="{{{ $user->getFormattedBirth() }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="email" placeholder="Email" value="{{{ $user->email }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-md-2 control-label">Mesto</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="city" placeholder="Mesto" value="{{{ $user->city }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="school" class="col-md-2 control-label">Škola</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="school" placeholder="Škola" value="{{{ $user->school }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default save">Ulož</button>
                        </div>
                    </div>
                </form>
                @else
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-briefcase"></span> {{{ User_group::find($user->roles()->orderBy('rank_id', 'ASC')->first()->rank_id)->description }}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-birthday-cake" style="width: 14px"></i> <span class="text">{{{ $user->getFormattedBirth() }}}</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-envelope"></span> <span class="text">{{{ $user->email }}}</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-home" style="width: 14px"></i> {{{ $user->city }}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-graduation-cap" style="width: 14px"></i> <span class="text">{{{ $user->school }}}</span></p>
                    </div>
                </div>
                @endif
            </div>
        </div>
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