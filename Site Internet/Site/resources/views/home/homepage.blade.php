

@extends ('layouts.master')



@section ('content')

    @include ('home.carroussel')
    @include ('home.offers')




    <div class="container">
        <div class="row">
            <h2>Nos différents sites</h2>

            <br>
        </div>

        <div class="row">

        @foreach($sites as $site)
            @include ('home.sites')
        @endforeach

        </div>
    </div>
    <!-- /.row -->
@endsection