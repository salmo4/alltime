<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        @if(Config::get('app.locale') == 'hu')


        <h2>Bine ați venit la pagina de licitație</h2>

        <div>
            <a href="{{ URL::to('/') }}"> {{ URL::to('/') }} </a> 
            <br/><br/>
            <div>Introduceți adresa de e-mail {{ $email }}</div>
            <br/><br/>
            Toate cele bune,,<br/>
            Admin<br/>
            samy.gui95@gmail.com

        </div>


        @else


        <h2>Welcome to AllTime</h2>

        <div>

            <a href="{{ URL::to('/') }}"> {{ URL::to('/') }} </a> 
            <br/><br/>
            <div>You can log in with this email: {{ $email }}</div>
            <br/><br/>
            Bye,<br/>
            Admin<br/>
            samy.gui95@gmail.com
        </div>


        @endif  


    </body>
</html>
