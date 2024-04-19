<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('dashboard/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/a9a5fe0466.js" crossorigin="anonymous"></script>

        <style>
            #map {
                width : 100%;
                height: 400px; 
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            @include('parts.header')

            @include('parts.sidebar')

            <div id="layoutSidenav_content">

                @yield('content')

                @include('parts.footer')

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/datatables-simple-demo.js') }}"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function(){

                //Logout Button
                $('#logout-btn').click(function(){
                    $('#logout-form').submit();
                });

                //Datatable
                let table = new DataTable('#myTable');

                initMap();
            });


            //Map Integration
            let maps;
            let activeInfoWindow;
            let markers = [];

            function initMap()
            {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: 30.37,
                        lng: 69.34
                    },
                    zoom: 8  //the more number increasing the more it will be zooming..
                });
            }
        </script>    
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&amp;libraries=places&amp;callback=initMap" async></script>
    </body>
</html>

