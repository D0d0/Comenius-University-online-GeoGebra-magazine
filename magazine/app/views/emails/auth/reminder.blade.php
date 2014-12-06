<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Resetnutie hesla</h2>

        <div>
            Kliknutím na nasledujúci link si obnovíte zabudnuté heslo
            {{ action('RemindersController@getReset', [$token]) }}.<br/>
        </div>

    </body>
</html>
