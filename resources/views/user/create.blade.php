
@extends('layout.main')


@section('title') Create User @stop



@section('content')
<style>
    .error{
        color: #c00; 
        margin-left: 10px;
    }

</style>
<script>

</script>

<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif

    
    <!--
    <a href="{{ URL::to('login/fb')}}"> HTML::image('img/liwf.png', 'Login with Facebook',  ['width' =>'300px;']) </a>
    
    <br><br>
    <h3><i class='fa fa-user'></i>  {{  trans('c.Or') }}</h3>
    <br>
    -->
    <h2><i class='fa fa-user'></i>  {{  trans('c.User registration') }}</h2>

    {{ Form::open(['role' => 'form', 'url' => 'user/store']) }}



    <div class='form-group'>

        {{ Form::label('name', "Username:") }}
        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('password', trans('c.Password').":" )}}
        {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('password_confirmation', trans('c.Confirm Password').":" ) }}
        {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit(trans('c.Create'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
    </div>

    {{ Form::close() }}

</div>

@stop