@extends('layout.main')
@section('title')
@stop

@section('head')

@stop

@section('content')


<div class="container">

    <div class="row">


        <div class='col-xs-6' >

              {{ Form::model($category, array('route' => array('category.edit', $category->id))) }}	

              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$category->id}}" />
                <br>
                <div class='form-group'>
                    {{ Form::label('name', "Category name:") }}
                    {{ Form::text('name',$category->name,  [ 'class' => 'form-control' ] ) }}
                </div>
                
               <div class='form-group'>
                    {{ Form::label('picture', "Picture name:") }}
                    {{ Form::text('picture',$category->picture ,  [ 'class' => 'form-control' ] ) }}
                </div>

                <input class="btn btn-info"  type="submit" name="submit" value="OK" />

            </form>



            <br>  <br>
        </div>
    </div>

</div>

@stop
