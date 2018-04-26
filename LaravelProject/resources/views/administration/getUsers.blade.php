@if(Auth::check() && auth()->user()->isAdmin )

    @extends('administration.layout.master')



    @section('content')


    @endsection
@endif