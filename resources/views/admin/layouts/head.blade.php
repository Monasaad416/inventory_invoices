
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jqvmap/jqvmap.min.css')}}">
<!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/dist/css/adminlte_rtl.css')}}">





  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

  <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/bs-stepper/css/bs-stepper.min.css')}}">


  <!-- toggle button on-off -->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
    /*custom styles */

    /* .search_term {
        background-color : #edf0f9;
    } */


    .toggle-handle{
        background-color: #e9e1e1 !important;
    }


    .select2-container--default .select2-selection--single {
        border-color: #d0d4da;
        height: 38px;
        margin-top: 5px
    }
    #example1_wrapper {
        overflow-x: auto; /* Enable vertical scrolling when the content exceeds the height */
    }
</style>






  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">




@stack('css')
<style>
  table thead{
    background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important;
    color: #fff !important;
  }

      .card-body {
        overflow-x: auto; /* Enable vertical scrolling when the content exceeds the height */
    }

</style>



@livewireStyles


  {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
  {{-- <script src="//js.pusher.com/8.0.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    @if(Auth::check())
    // var pusher = new Pusher('fd0deecaa67438463358', {
    //   cluster: 'ap2'
    // });

    var pusher = new Pusher('fd0deecaa67438463358',

        {cluster: 'ap2',
            channelAuthorization: {
                endpoint: "{{ url('/') }}" ,
                headers: { "X-CSRF-Token": '{{ csrf_token() }}' }
            }  
        }
    );
    @endif

    const userId = "{{ Auth::id() }}";

    var channel = pusher.subscribe(`App.Models.User.${userId}`);
    channel.bind('App\\Events\\NewInvoiceCreatedEvent', function(data) {
    //   $('#notificationIcon').load('#notificationIcon > *');
    //   $('#notificationsList').load('#notificationsList > *');
    console.log(data,"lkkk");

    });
  </script> --}}

@vite('resources/js/admin.js')
</head>



