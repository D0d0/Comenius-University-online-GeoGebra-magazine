<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Článok čaká na publikovanie</h2>

        <div>
            Recenzent zrecenoval článok, ktorý teraz čaká na posledné schválenie od člena redakčnej rady
            {{ action('ArticleController@detail', [$id]) }}.<br/>
        </div>

    </body>
</html>