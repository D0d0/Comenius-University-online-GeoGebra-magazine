<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Nový článok na recnzovanie</h2>

        <div>
            Bol Vám priradený nový článok na orecenzovanie. Pre jeho zobrazenie kliknite na link 
            {{ action('ArticleController@detail', [$id]) }}.<br/>
        </div>

    </body>
</html>