<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Homepage</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">        <link href="{{ asset('dashboard/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: {{ $userData->designs->banner_color ?? '#000000' }}">
            <div class="container px-5">
                <a class="navbar-brand" href="{{ route('home') }}">Todo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        @auth
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <li class="nav-item"><a class="nav-link" id="logout-btn">Logout</a></li>
                        </form>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                       @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::check())
            <div class="container mt-5">
                <div class="heading-top bg-secondary mt-3 mb-3 pt-3 pb-3 ps-3 pe-3 text-center">
                    <h2 class="heading mt-2 text-white">Listed Tasks</h2>
                </div>

                <div class="search-container mt-2 mb-2 pt-4 pb-4">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <label for="form-label">Search: <small>Title or Description</small></label>
                            <input type="text" class="form-control" name="search-task" id="search-task">
                        </div>
                    </div>
                </div>

                <div class="row" id="display_todo">
                    {{-- @dd($tasks) --}}
                    @if(count($tasks)>0)
                        @foreach ($tasks as $task)
                            <div class="col-lg-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><h5>Title:</h5>{{ $task->title }}</h5>
                                        <p class="card-text"><h5>Description:</h5>{{ $task->description }}</p>
                                        <p class="card-text"><h5>Posted By:</h5>{{ $task->users->name }}</p>
                                        <p class="card-text"><h5>Assigned To:</h5>{{ $task->assignedTo->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <h4>Your database must have no record. Please add some. <a href="{{ route('create-task') }}">Posts</a></h4>
                        </div>
                    @endif
                </div>

                <div class="pagination mt-2">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <h4>Once you're login you will have something here.</h4>
                    </div>
                </div>
            </div>
        @endif


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}


        <script>
            $(document).ready(function(){
                $('#logout-btn').click(function(){
                    $('#logout-form').submit();
                });
            });

            $(document).ready(function(){
                $('#search-task').on('keyup', function(){
                    var value =$(this).val();

                    $.ajax({
                        url: "{{ route('searchTasks') }}",
                        type: "GET",
                        dataType: "json",
                        data:
                        {
                            'searching': value
                        },

                        success:function(task)
                        {
                            $('#display_todo').empty();
                            $.each(task, function(index, data){
                                console.log(data);

                                var assignedToName = data.assigned_to ? data.assigned_to.name : 'Not Assigned';

                                var newRow = `
                                <div class="row">
                                    <div class="col-lg-4 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><h5>Title:</h5>${data.title}</h5>
                                                <p class="card-text"><h5>Description:</h5>${data.description}</p>
                                                <p class="card-text"><h5>Posted By:</h5>${data.user_id}</p>
                                                <p class="card-text"><h5>Assigned To:</h5>${assignedToName}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                var $newRow = $(newRow);
                                $('#display_todo').append($newRow);
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
