
@extends('layout.main')
@section("content")

<div class="container">

    <h2>SuperSami</h2><br><br>
    <div class="list-group">

        <a class="list-group-item active" href="{{ URL::to('product/superadminproductlist')}}" target="_blank"> Moderation</a>
        <br>
        <a class="list-group-item" href="{{ URL::to('admin/users')}}" target="_blank"> Administrator</a>

    </div>
</div>
@stop



