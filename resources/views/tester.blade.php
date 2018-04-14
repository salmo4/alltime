@section('content')



<div class="container" style="width:60%">

    @if (Session::has('error'))
    <p style="color:red;font-weight: bold;">{{ Session::get('error') }}</p>
@endif

@if (Session::has('message'))
    <p style="color:red;font-weight: bold;">{{ Session::get('message') }}</p>
@endif


  NULL template
</div>
@stop