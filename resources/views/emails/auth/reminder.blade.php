<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        @if(Config::get('app.locale') == 'hu')


        <h2>Jelszó visszaállítás </h2>

        <div>
            Kérlek, a jelszó visszaállításhoz kattints az alábbi linkre : 
            <br/><br/>
            <a href="{{ URL::to('password/reset', array($token)) }}"> {{ URL::to('password/reset', array($token)) }} </a> 
            <br/><br/>
            Ez a link {{ Config::get('auth.reminder.expire', 60) }} percig használható.
            <br/><br/>
            Üdvözlettel,<br/>
            Admin<br/>
            blogbookhu@gmail.com 

        </div>


        @else


        <h2>Password Reset</h2>

        <div>
            To reset your password, complete this form: 
            <br/><br/>
            <a href="{{ URL::to('password/reset', array($token)) }}"> {{ URL::to('password/reset', array($token)) }} </a> 
            <br/><br/>
            This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
            <br/><br/>
            Bye,<br/>
            Admin<br/>
            blogbookhu@gmail.com 
        </div>


        @endif  


    </body>
</html>
