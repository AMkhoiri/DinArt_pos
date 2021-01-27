<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="{{ asset('dinart.png')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/fontawesome-free/css/all.min.css')}}"> 
  
  {{-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> --}}
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 

   <link rel="stylesheet" href="{{asset('dinart/dist/css/adminlte.min.css')}}"> 
     <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dinart/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


{{-- {{asset('dinart/plugins/toastr/toastr.min.css')}} --}}
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('dinart/plugins/toastr/toastr.min.css')}}">

  @yield('css')

  <style>

    body{
     /*font-family: 'Poppins', sans-serif;*/

    }

    .logg:hover{
      font-weight: bold;
       transition: 0.4s;
       background-color: white;
       color: grey !important;
    }

    .logg:active {
    
    background-color: white;
    color: grey;
    }

    .logg:focus{
      background-color: white;
    }

    .dropdown-item:onclick{
      background-color: red;
    }

    .nav-item .nav-linkk:hover{
      /*color:#f07f02 !important;*/
      color:#white !important;
      letter-spacing: 0.6px;
      transition: 0.2s;
    }


/*preloader*/
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 12px arial;
    }
    
    
  </style>
</head>




<body class="hold-transition sidebar-mini">
{{-- preloader --}}

 <div class="preloader">
      <div class="loading">
        <img src="{{ asset('preloader/loader2.gif') }}" width="77">
        <p></p>
      </div>
    </div>

<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light " style="box-shadow: 0px 0.5px 6px #999;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">  @yield('page-title')</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto mr-2">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link d-inline" data-toggle="dropdown" href="#"> 
         <span>{{ Auth::user()->name }}</span> 
           <span class="fas fa-angle-down ml-1" >
          
        </a>
        {{-- # --}}
        <span class="badge  font-weight-normal ml-0 pl-2 pr-2 pt-1 pb-1 d-inline" style="font-size: 12px; background-color: darkorchid; color: white;"  > <i style="font-size: 12px;" class="fas fa-shield-alt" > Admin </i> </span> 
        {{-- <i class="fas fa-envelope bg-blue"></i> --}}
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          
           
            <div class="media " >   
              <div class="media-body">
   
                        <a class="dropdown-item logg "  href="{{-- {{ route('logout') }} --}}"
                           {{-- onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" --}} style="text-decoration: none;" >
                            {{ __('Logout') }} <span class="fas fa-sign-out-alt float-right" style="font-size: 16px;  color: grey;"></span> 
                        </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

              </div>
            </div>
          
        </div>
      </li>

    </ul>
    
  </nav>
  <!-- /.navbar -->



  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a style=" margin-left: 6px;" href="#" class="brand-link mb-2 mt-2">
      <img src=" {{asset('dinart/dinart.png')}}"
           alt="AdminLTE Logo"
           class=" ml-2 mb-3" style="width:38px !important; height: auto !important;">
      <span class=" font-weight-bold  ml-2" style="padding-bottom: 0px !important; margin-bottom: 0px !important;"> DinArt App</span>
    </a>


    {{--  <a style=" margin-bottom: 20px;" href="#" class="brand-link">
      <img src=" {{asset('dinart/dinart.png')}}" style="max-width: 35px; height: auto;"  alt="AdminLTE Logo" class="ml-3 mt-2 pb-0 mb-0">
      <span class="brand-text  font-weight-bold ml-2 pt-4 mt-2 pb-0 mb-0"> DinArt Printing</span>
    </a> --}}


  <!-- Sidebar -->
  <div class="sidebar">
 
      <!-- Sidebar user (optional) -->
     
    <div class="user-panel ml-1 mt-0 pb-1 mb-1 d-flex">
      <a href="#"style="font-size: 12px; margin-bottom: 5px;" class="badge font-weight-bold "><span class="fas fa-store-alt pr-1 pl-1 ml-2 mr-2"></span>Box {{$kode_box}}</a>
    </div>
    


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
   
          <li class="nav-item">
            <a href="{{ route('admin-dashboard') }}" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

        {{--   <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-desktop"></i>
              <p>
                Halaman Website
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item ml-2">
                <a href="#" class="nav-link nav-linkk ml-3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Display Product </p>
                </a>
              </li>
              <li class="nav-item ml-2">
                <a href="#" class="nav-link nav-linkk ml-3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Harga</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>

            <ul class="nav nav-treeview">
               <li class="nav-item ">
                <a href="{{ route('admin-datapegawai') }} " class="nav-link nav-linkk ml-3">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Pegawai
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('admin-databox') }} " class="nav-link nav-linkk ml-3">
                  <i class="nav-icon fas fa-store"></i>
                  <p>
                     Box/Stand
                  </p>
                </a>
            </li>
            </ul>
          </li>


         
          <li class="nav-item">
            <a href="{{ route('admin-datauser') }} " class="nav-link nav-linkk">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Data Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin-databarang') }} " class="nav-link nav-linkk">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Data Barang/Product
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href=" {{ route('admin-transaksi') }}" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href=" {{ route('admin-produksi') }}" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Produksi
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin-laporan-form') }}" class="nav-link nav-linkk">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan Penjualan
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-3">

    <section class="content">
       @yield('content')
    </section>
 
  </div>
  <!-- /.content-wrapper -->

  
    {!!$konfigurasi!!} 
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- .footer -->




<!-- ./footer -->


<!-- jQuery -->
<script src="{{asset('dinart/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dinart/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dinart/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dinart/dist/js/demo.js')}}"></script>

<!-- DataTables -->
{{-- {{asset('dinart/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}} --}}
<script src="{{asset('dinart/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dinart/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('dinart/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dinart/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Bootstrap Switch -->
{{-- <script src="{{asset('dinart/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> --}}

<!-- SweetAlert2 -->
<script src="{{asset('dinart/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('dinart/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Select2 -->
<script src="{{asset('dinart/plugins/select2/js/select2.full.min.js')}}"></script>


@include('sweetalert::alert')
</body>

{{-- declare bootstrap tooltip --}}
<script type="text/javascript">

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>





{{-- declare toastr --}}
<script>
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3500
    });

</script>


<script>
  
  // sweetalert logout confirmation
 
$('body').on('click', '.logg', function(event) {
  event.preventDefault();

  Swal.fire({
        title:'Hmmm :( ',
        text: 'Are you sure to exit this app?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#003368',
        icon: 'question',
        imageUrl: "{{ asset('dinart/sad-flat.png') }}",
        imageAlt: 'Custom image',
        imageWidth: 230,
        imageHeight: 230,
        // width:440,
        confirmButtonText: 'Yes, i need to rest!',
        cancelButtonText: 'No, stay'
  }).then((result) => {
      
      if (result.value) {  
        event.preventDefault();
        
        window.location.href = "{{ route('logout') }}"
          document.getElementById('logout-form').submit();
      }
  })

});

</script>


<script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
</script>


@yield('js')




</html>
