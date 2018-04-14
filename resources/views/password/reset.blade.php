@extends('layout.main')

@section('content')



    <div class="col-lg-4 col-lg-offset-4">   


        <h2>Reset your password</h2>

        {{ Form::open() }}

        {{ Form::hidden('token', $token) }}

        <div class='form-group'>

            {{ Form::label("email", "E-mail: ") }}
            {{ Form::email("email", null,  [ 'class' => 'form-control','required' ]) }}



        </div>

        <div class='form-group'>

            {{ Form::label("password", "Password: ") }}
            {{ Form::password("password",  [ 'class' => 'form-control','required' ]) }}

        </div>

        <div class='form-group'>

            {{ Form::label("password_confirmation", "Password confirmation: ") }}
            {{ Form::password("password_confirmation",  [ 'class' => 'form-control','required' ]) }}

        </div>

        <div class='form-group'>
            {{ Form::submit('Submit', ['class' => 'btn btn-primary form-control']) }}
        </div>


        {{ Form::close() }}
    </div>

@stop
