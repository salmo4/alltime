@extends('layout.main')

@section('content')



  <div class="col-lg-4 col-lg-offset-4">   


        <h2> {{  trans('c.Need to reset your password?') }}</h2>

        {{ Form::open() }}

        <div class='form-group'>

            {{ Form::label("email", "E-mail: ") }}
            {{ Form::email("email", null,  [ 'class' => 'form-control','required' ]) }}<br />



        </div>

        <div class='form-group'>
            {{ Form::submit( trans('c.Reset Password'), ['class' => 'btn btn-primary form-control']) }}
        </div>

        {{ Form::close() }}
    </div>

@stop
