@extends('layouts.center_content')

@section('ready_js')
    var notBanned = {{ User::NOT_BANNED }};
    var banned = {{ User::BANNED }};
    
    var redaction = {{ User::REDACTION }};
    var reviewer = {{ User::REVIEWER }};
    var row;
    
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

    $('.btn').on('click', function(){
        row = $(this).closest('tr');
        var user_id = row.attr('id');
        var state = $(this).hasClass('ban') ? banned : notBanned;
        changeBan(user_id, state);
    });

    $('.reviewer').on('click', function(){
        var user_id = $(this).closest('tr').attr('id');
        changeRank(user_id, reviewer, $(this).is(':checked'));
    });

    $('.redaction').on('click', function(){
        var user_id = $(this).closest('tr').attr('id');
        changeRank(user_id, redaction, $(this).is(':checked'));
    });
@stop

@section('center')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-hover">
            <thead>
            <th>{{ Lang::get('common.name') }}</th>
            <th class="text-center">{{ Lang::get('article.redacion') }}</th>
            <th class="text-center">{{ Lang::get('article.reviewer') }}</th>
            <th class="text-center">{{ Lang::get('common.ban_user') }}</th>
            <th class="text-center">{{ Lang::get('common.unban_user') }}</th>
            </thead>
            <tbody>
                @foreach(User::orderBy('name', 'ASC')->get() as $user)
                <tr id="{{ $user->id }}">
                    <td style="vertical-align: middle">{{{ $user->name }}}</td>
                    <td class="text-center" style="vertical-align: middle">{{ Form::checkbox($user->id, User::REDACTION, $user->hasRank(User::REDACTION), array('class' =>'redaction')) }}</td>
                    <td class="text-center" style="vertical-align: middle">{{ Form::checkbox($user->id, User::REVIEWER, $user->hasRank(User::REVIEWER), array('class' =>'reviewer')) }}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop