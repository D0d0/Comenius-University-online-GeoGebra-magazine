@extends('layouts.center_content')

@section('ready_js')
    @if(Auth::user()->hasRank(User::ADMIN))
        var notBanned = {{ User::NOT_BANNED }};
        var banned = {{ User::BANNED }};
    @endif
    
    var redaction = {{ User::REDACTION }};
    var reviewer = {{ User::REVIEWER }};
    var row;
    
    @if(Auth::user()->hasRank(User::ADMIN))
        var toggleRow = function(obj){
            var banButton = $(obj).find('.ban');
            var unbanButton = $(obj).find('.unban');
            if(banButton.hasClass('disabled')){
                banButton.removeClass('disabled');
                unbanButton.addClass('disabled');
            }else{
                unbanButton.removeClass('disabled');
                banButton.addClass('disabled');        
            }
        };
    @endif
    
    @if(Auth::user()->hasRank(User::ADMIN))
        var changeBan = function(user_id, state){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ action('UserController@postChangeBan') }}',
                data: {
                    'user_id' : user_id,
                    'state' : state,
                },
                success: function(answer){
                    if(answer['result']){
                        toggleRow(row);
                    }
                },
                error: function(){

                }
            });
        };
    @endif
    
    var changeRank = function(user_id, rank, active){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ action('UserController@postChangeRank') }}',
            data: {
                'user_id' : user_id,
                'rank' : rank,
                'active' : active,
            },
            success: function(answer){
                
            },
            error: function(){
                
            }
        });
    };
    
    @if(Auth::user()->hasRank(User::ADMIN))
        $('.btn').on('click', function(){
            row = $(this).closest('tr');
            var user_id = row.attr('id');
            var state = $(this).hasClass('ban') ? banned : notBanned;
            changeBan(user_id, state);
        });
    @endif

    $('.reviewer').on('click', function(){
        var user_id = $(this).closest('tr').attr('id');
        changeRank(user_id, reviewer, $(this).is(':checked'));
    });
    
    @if(Auth::user()->hasRank(User::ADMIN))
        $('.redaction').on('click', function(){
            var user_id = $(this).closest('tr').attr('id');
            changeRank(user_id, redaction, $(this).is(':checked'));
        });
    @endif
@stop

@section('center')
<div class="row">
    <div class="@if(!Auth::user()->hasRank(User::ADMIN)) col-md-6 col-md-offset-3 @else col-md-8 col-md-offset-2 @endif">
        <table class="table table-hover">
            <thead>
                <th>{{ Lang::get('common.name') }}</th>
                @if(Auth::user()->hasRank(User::ADMIN))
                    <th class="text-center">{{ Lang::get('article.redaction') }}</th>
                @endif
                <th class="text-center">{{ Lang::get('article.reviewer') }}</th>
                @if(Auth::user()->hasRank(User::ADMIN))
                    <th class="text-center">{{ Lang::get('common.ban_user') }}</th>
                    <th class="text-center">{{ Lang::get('common.unban_user') }}</th>
                @endif
            </thead>
            <tbody>
                @foreach(User::orderBy('name', 'ASC')->get() as $user)
                <tr id="{{ $user->id }}">
                    <td style="vertical-align: middle">{{{ $user->name }}}</td>
                    @if(Auth::user()->hasRank(User::ADMIN))
                        <td class="text-center" style="vertical-align: middle">{{ Form::checkbox($user->id, User::REDACTION, $user->hasRank(User::REDACTION), array('class' =>'redaction')) }}</td>
                    @endif
                    <td class="text-center" style="vertical-align: middle">{{ Form::checkbox($user->id, User::REVIEWER, $user->hasRank(User::REVIEWER), array('class' =>'reviewer')) }}</td>
                    @if(Auth::user()->hasRank(User::ADMIN))
                        <td class="text-center">
                            <button type="button" class="btn btn-success unban @if(!$user->isBanned()) disabled @endif">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td class="text-center"> 
                            <button type="button" class="btn btn-danger ban @if($user->isBanned()) disabled @endif">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop