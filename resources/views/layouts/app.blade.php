<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gnams.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gna/gna.css') }}">
    <script src="{{ asset('jquery/js/jquery-3.6.0.min.js') }}"></script>
    
    <title>GNA</title>
</head>

<body>
    @include('layouts.partials.nav-bar')
    <div style="position: fixed; z-index: 90; width: 100%; height: 100%; display: none; background-color: grey; opacity: 0.8;" id="loadingImg">
        <img src="{{ asset('loading.gif') }}" alt="" style="display: block; margin-left: auto; margin-right: auto; margin-top: 5%; height: 40%; border-radius: 25px;">
    </div> 
    <main class="container-fluid py-2">
        
        @yield('content')
        @include('layouts.modals.change-pass')
        @include('layouts.modals.user-profile')
    </main>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/js/datatables.min.js') }}"></script>
    <script src="{{ asset('gna/gna.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        })
        
    </script>
</body>

</html>