@extends('layout.main')

@section('content')
<style>
    .error{
        color: #c00; 
        margin-left: 10px;
    }

</style>


<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif





    <h2>{{trans('c.Currency setting')}}</h2>
    {{ Form::model($user, array('route' => array('user/edit', $user->id))) }}	

    {{ Form::hidden('onlycurrency', 1) }}

    <div class='form-group'>
        {{ Form::label('', trans('c.Currency').":" ) }}
        {{ Form::select('currency_id', $currency_list, Request::old('currency_id'),  [ 'class' => 'form-control']) }}
    </div>


    <div class='form-group'>
        {{ Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
    </div>

    {{ Form::close() }}
    <br><br>

    <h2><i class='fa fa-user'></i>  {{  trans('c.User data Setting')}}</h2>

    {{ Form::model($user, array('route' => array('user/edit', $user->id))) }}	

    {{ Form::hidden('onlycurrency', 0) }}

    <div class='form-group'>

        {{ Form::label('name', trans('c.nameOfUser').":") }}
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
        {{ Form::label('', trans('c.Currency').":" ) }}
        {{ Form::select('currency_id', $currency_list, Request::old('currency_id'),  [ 'class' => 'form-control']) }}
    </div>


    <div class='form-group'>
        {{ Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
    </div>

    {{ Form::close() }}





</div>

@stop