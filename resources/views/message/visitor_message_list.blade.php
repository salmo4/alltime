
@extends('layout.main')
@section("content")

<div class="container">


    <table class="table">
        <tbody>
            <tr>
                <td>
                    <h4>messages</h4>
                </td>
                <td>
                    <h4>email</h4>
                </td>



            </tr>
            @foreach($message_list as $item)
            <tr>
                  <td>
                    {{$item->message}}
                </td>
                <td>
                    {{$item->email}}

                </td>


            </tr>

            @endforeach

        </tbody>
    </table>

</div>
@stop



