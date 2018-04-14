@section('head')
@extends('layout.main')
@section('content')


<div class="container" style="width:60%">

    <h3>  Category    </h3>

 <a  href="{{ URL::to('category/add') }}" >  + add new category</a>  

        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Picture
                    </th>
                  <th>
                   
                  </th>
                  <th>
                   
                  </th>
                </tr>
            </thead>   
            <tbody>
                   @foreach($categories as $key => $category)
                <tr>
                    <td>  {{$category['name']}}</td>
                     <td>  {{$category['picture']}}</td>
                      <td>   <a  href="{{ URL::to('category/edit/'.$category['id']) }}" >  edit</a>  
                      </td>
                      <td>   <a  href="{{ URL::to('category/delete/'.$category['id']) }}"  onclick="if (!confirm('Are you sure to delete this category?')) {
                                return false;
                            }
                            ;">  delete</a>  
                      </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        








    @stop
