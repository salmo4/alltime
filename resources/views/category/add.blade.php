@extends('layout.main')
@section('title')
@stop

@section('head')

@stop

@section('content')


<div class="container">

    <div class="row">


        <div class='col-xs-6' >

              <form action="{{ URL::to('category/add')}}"  method="post" accept-charset="UTF-8">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class='form-group'>
                    {{ Form::label('name', "Category name:") }}
                    {{ Form::text('name',null ,  [ 'class' => 'form-control' ] ) }}
                </div>
                   
                <div class='form-group'>
                    {{ Form::label('picture', "Picture name:") }}
                    {{ Form::text('picture',null ,  [ 'class' => 'form-control' ] ) }}
                </div>

                <input class="btn btn-info"  type="submit" name="submit" value="OK" />

            </form>



            <br>  <br>
        </div>
    </div>

</div>

@stop
