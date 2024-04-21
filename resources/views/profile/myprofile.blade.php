@extends('layouts.app')
@section('content')
    <section style="background-color: #eee;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center mb-4 position-relative">
                                <img src="{{ asset('dashboard/images/vilnius.jpeg') }}" alt="User Image" class="img-fluid rounded-circle" style="width: 160px; height: 160px;">
                                <div class="upload-icon" id="image-upload">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>

                            <form action="{{ route('update-user', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mb-0">Name:</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ Auth::user()->name ?? '' }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="mb-0">Email:</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" value="{{ Auth::user()->email ?? '' }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">{{ Auth::user()->name }}'s Tasks</h4>

            <div class="card">
                <div class="card-body">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Task Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                       
                        <tbody>
                            {{-- @dd($users); --}}
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        @if($task->is_completed == 0)
                                            <span style="color: red; font-weight: bold;">Pending</span>
                                        @elseif($task->is_completed == 1)
                                            <span style="color: green; font-weight: bold;">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('view-task', $task->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('delete-Tasks', $task->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm fa-solid fa-trash-can"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            initMap();
        });


        $('#image-upload').click(function(){
            alert('asdasdsa');
        });

        //Map Integration
        let maps;
        let activeInfoWindow;
        let markers = [];

        function initMap()
        {
            //Getting user lat and lng

            var user_lat = {{ Auth::user()->lat }};
            var user_lng = {{ Auth::user()->lng }};


            //Main Map
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: user_lat,
                    lng: user_lng
                },
                zoom: 5  //the more number increasing the more it will be zooming..
            });

            //Setting-up Marker
            markers = new google.maps.Marker({
                position: {
                    lat: user_lat,
                    lng: user_lng
                },
                map: map,
                title: "Marker Title"
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&amp;libraries=places&amp;callback=initMap" async></script>
@endsection
