@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-2">Dashboard</h3>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Users - <small>{{ $user }}</small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('view-Users') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">Total Tasks - <small>{{ $task }}</small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('view-Tasks') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Pending Tasks - <small>{{ $pendingtask }}</small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('view-Tasks') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Completed Tasks - <small>{{ $completedtask }}</small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('view-Tasks') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- User's Map --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function(){

        initMap();

    });

    //we use let for globally access.
    let maps;
    let activeInfowindow;
    let markers = [];

    function initMap()
    {
        map = new google.maps.Map(document.getElementById("map"),{
            center: {lat: 39.8103, lng: 69.4125},
            zoom: 5,
        });

        var markers = [
            {
                position: { lat: 39.8103, lng: 69.4125 },
                title: "User 1"
            },

            {
                position: { lat: 41.8103, lng: 68.4125 },
                title: "User 2"
            },

            {
                position: { lat: 45.8103, lng: 65.4125 },
                title: "User 3"
            },

            {
                position: { lat: 42.8103, lng: 62.4125 },
                title: "User 4"
            }
        ];

        for(var i = 0; i < markers.length; i++)
        {
            marker = new google.maps.Marker({
                position: markers[i].position,
                map: map,
                title: markers[i].title
            });
        }
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&amp;libraries=places&amp;callback=initMap" async></script>
@endsection
