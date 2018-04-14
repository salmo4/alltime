
@extends('layout.main')
@section("content")



<div class='col-lg-4 col-lg-offset-4'>
<!--
    <a href="{{ URL::to('redirect')}}"><img src="{{URL::asset('img/liwf.png')}}" alt="Login with Facebook" style="width:300pt" ></a>


    <br><br>

    <h3> {{  trans('c.Or') }}</h3>
    <br>
    -->
    <p>
       <i class='fa fa-user'></i>  Test user: <br>
        email: <strong>samy.gui95@gmail.com</strong>  <br>
        password: <strong>666</strong>
    </p>
    
    
    {{ Form::open(array('action' => 'UserController@postLogin')) }}
    {{ $errors->first("password") }}<br />


    <div class='form-group'>
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) }}
    </div>




    <div class='form-group'>
        {{ Form::label('password', trans('c.Password').":" )}}
        {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>



    <div class='form-group'>
        {{ Form::button('<i class="fa fa-sign-in fa-1x " ></i> '.'Log in' , ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
    </div>

    {{ Form::close() }}
    <br><br>
    <a href="{{ URL::to('user/create')}}" class="btn btn-default"><i class="fa fa-pencil fa-1x " ></i> {{  trans('c.Registration') }}</a>

    <br><br>
   <!-- <a href="{{ URL::to('/password/remind')}}"> {{  trans('c.Password remind') }}</a>-->
    
     <a href="{{ URL::to('/password/reset')}}" class="btn btn-default"><i class="fa fa-unlock fa-1x " ></i> Password reset</a>
    <br>     <br>

</div>

@stop



