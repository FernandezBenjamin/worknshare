
    <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
            <a href="#"><img class="card-img-top" src="/images/sites/{{$site->filename}}" alt="Work'n Share de {{ $site->city }}"></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#">WORK'N SHARE {{ strtoupper($site->city) }}</a>
                </h4>
                <p class="card-text">
                <p class="underline">
                    A votre disposition :
                </p>
                <br>


                <ul>

                        @foreach($site->services as $service)
                            <li>{{ $service->service_name }}</li>
                        @endforeach
                        @foreach($site->rooms as $room)
                            @if($room->quantity > 0)
                                <li>{{ $room->quantity }} {{ $room->room_name }}</li>
                            @endif
                        @endforeach
                        @foreach($site->equipements as $equipement)
                            @if($equipement->quantity > 0)
                                <li>{{ $equipement->quantity }} {{ $equipement->equipement_name }}</li>
                            @endif
                        @endforeach

                </ul>

                <br>
                <br>
                <p class="underline">
                    Horaires :
                </p>
                {{ $site->hours }}
                </p>
            </div>
        </div>
    </div>