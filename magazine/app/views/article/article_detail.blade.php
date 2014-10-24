@extends('layouts.six_three_layout')

@section('js')
<script type="text/javascript" src="http://www.geogebratube.org/scripts/deployggb.js"></script>
@stop

@section('style')
[type=clanok]{
padding: 9px;
}

.img-rounded{
margin-bottom: 9px !important;
}
@stop

@section('ready_js')
$('#frame').attr('src', 'http://www.geogebratube.org/material/iframe/id/23587/width/'+$('[type=clanok]').innerWidth()+'/height/640/border/888888/rc/false/ai/false/sdz/true/smb/false/stb/false/stbh/true/ld/false/sri/false/at/preferhtml5');
@stop

@section('left')
<div class="row">
    <div class="col-md-12">
        <div class="thumbnail clearfix" type="clanok">
            <h1>Nadpis</h1>
            <p class="text-muted">
                <span class="glyphicon glyphicon-calendar"></span> Ut. 1. apríl 2014
            </p>
            <p class="text-muted">
                <span class="glyphicon glyphicon-tags"></span>
                &nbsp;<a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">kosinus</a>
                <a class="label label-primary">sinus</a>
                <a class="label label-primary">Tag3</a>
                <a class="label label-primary">Tag4</a>
                <a class="label label-primary">Pytagorova veta</a>
                <a class="label label-primary">Tag5</a>
            </p>
            <!-- abstrakt -->
            <p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>
            <!-- text -->
            <p><h3 style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 11px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; line-height: normal;">Štandardná pasáž z&nbsp;Lorem Ipsum, používaná od 16.storočia</h3><p style="text-align: justify; font-size: 11px; line-height: 14px; margin-bottom: 14px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 11px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; line-height: normal;">Odsek 1.10.32 z&nbsp;textu "De finibus bonorum et malorum", ktorý napísal Cicero v&nbsp;roku 45 pred n.l.</h3><p style="text-align: justify; font-size: 11px; line-height: 14px; margin-bottom: 14px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 11px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; line-height: normal;">Preklad od H. Rackhama z&nbsp;roku 1914</h3><p style="text-align: justify; font-size: 11px; line-height: 14px; margin-bottom: 14px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p><h3 style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 11px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; line-height: normal;">Odsek 1.10.33 z&nbsp;textu "De finibus bonorum et malorum", ktorý napísal Cicero v&nbsp;roku 45 pred n.l.</h3><p style="text-align: justify; font-size: 11px; line-height: 14px; margin-bottom: 14px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans;">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p><h3 style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 11px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; line-height: normal;">Preklad od H. Rackhama z&nbsp;roku 1914</h3><p style="text-align: justify; font-size: 11px; line-height: 14px; margin-bottom: 14px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans;">"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p> new:67
            <p>
                <iframe id="frame" scrolling="no"
                        src=""
                        width="100%"
                        height="640"
                        style="border:0px;">
                </iframe>
            </p>
        </div>
    </div>
</div>
@stop

@section('right')
<div class="row">
    <div class="col-md-12">
        <div class="thumbnail clearfix" type="clanok">
            <div>
                <img src="{{URL::asset('img/apache_pb.png')}}" alt="..." class="img-rounded">
            </div>
            <h3>Meno priezvisko</h3>
            <h4>{{ Lang::get('article.other_articles') }}</h4>
            <p>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
            </p>
            <h4>{{ Lang::get('article.related_articles') }}</h4>
            <p>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> kosinus</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> sinus</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag3</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag4</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Pytagorova veta</a>
                <a class="label label-primary"><span class="glyphicon glyphicon-tags"></span> Tag5</a>
            </p>
        </div>
    </div>
</div>
@stop