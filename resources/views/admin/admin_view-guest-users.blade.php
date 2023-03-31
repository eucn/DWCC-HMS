<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  @vite('resources/css/app.css')

  <title>Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Logo -->
  <link rel="icon" type="image/png" sizes="16x16" href="../images/sitelogo.png">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('template/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/3a364cef47.js" crossorigin="anonymous"></script>
    <script
      defer
      src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"
      integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp"
      crossorigin="anonymous">
    </script>

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Microhotel</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <!-- <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span> -->
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('admin')->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin</h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.changePassword') }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="">
        <div class="sibar-logo">
          <img src="{{ asset ('images/logom2.png') }}" class="h-[120px] mx-auto" alt="">
          <p class="text-[#bdb6b5] text-sm flex justify-center">Divine Word College of Calapan</p>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link nav-link-icon collapsed" href="{{ route('admin.room.index') }}">
          <i class="fa-solid fa-bed icon-nav"></i>
          <span>Manage Rooms</span>
        </a>
      </li><!-- End Manage Rooms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.bookingHistory') }}">
          <i class="fa-regular fa-file icon-nav"></i>
          <span>Booking History</span>
        </a>
      </li><!-- End Booking History Nav -->

      <li class="nav-item">
  <a class="nav-link dropdown-toggle collapsed" href="#" id="accounts-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-user icon-nav"></i><span>Accounts</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="tables-nav" class="dropdown-menu" aria-labelledby="accounts-dropdown">
    <li>
      <a class="dropdown-item" href="{{ route('admin.frontdeskList') }}">
        <i class="bi bi-circle"></i><span>Frontdesk</span>
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('admin.guestList') }}">
        <i class="bi bi-circle"></i><span>Guest</span>
      </a>
    </li>
  </ul>
</li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.reports') }}">
          <i class="fa-regular fa-file-lines icon-nav"></i>
          <span>Reports</span>
        </a>
      </li><!-- End Reports Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Registered Guest</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
<!-- 
            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Registered at</th>
    </tr>
  </thead>
  <tbody>
     @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
  </tbody>
</table> -->

  <table class="table table-condensed table-sm table-bordered">   
      <thead class="bg-[#36ae7c] text-white">   
          <tr style="text-align:center">   
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Registered at</th>
              <th scope="col">Account Status</th>
              <th scope="col">Action</th>
          </tr>   
      </thead>   
      <tbody>   
      @foreach ($users as $user)
          <tr>     
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->created_at }}</td>
              {{-- <td>{{ $user->Acc_Stat }}</td>--}}
              <td>
                @if ($user->Acc_Stat == 'Deactivate')
                    <p>{{ $user->Acc_Stat }}</p>
                @elseif ($user->Acc_Stat == 'Activate')
                    <p>{{ $user->Acc_Stat }}</p>
                @endif
              </td>
              <td>
              <!--View Button-->	
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable{{ $user->id }}">
                  <i class="fa-solid fa-eye"></i>
                </button>

                <!-- Button trigger activate modal -->
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#activate{{ $user->id }}">
                    <i class="fa-solid fa-user"></i>
                </button>

                <!-- Button trigger deactivate modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deactivate{{ $user->id }}">
                    <i class="fa-solid fa-user-slash"></i>
                </button>

                </td>  
                </tr> 
                <!-- View Modal -->
                    
                    <div class="modal fade" id="modalDialogScrollable{{ $user->id }}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" style="color: #55afab;">View Information</h5>
                            <button type="button" style="position:relative; left: 1px; color: #dc3545;" class="close"
                        data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                          <h6><strong>Name:</strong> {{ $user->name }}</h6><br>
                          <h6><strong>Email:</strong> {{ $user->email }}</h6><br>
                          <h6><strong>Registered at:</strong> {{ $user->created_at }}</h6><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
                          </div>  
                        </div> 
                      </div>    
                    </div>
                      <!-- Deactivate Modal -->
            
                     
<div class="modal fade" id="deactivate{{ $user->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.deactivate', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"  style="color: #55afab;">Deactivate User</h5>
                    <button type="button" style="position:relative; left: 1px; color: #dc3545;" class="close"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Deactivate</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- activate modal -->
<div class="modal fade" id="activate{{ $user->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.activate', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel " style="color: #55afab;">Activate User</h5>
                    <button type="button" style="position:relative; left: 1px; color: #dc3545;" class="close"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to activate this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Activate</button>
                </div>
            </form>
        </div>
    </div>
</div>
                        
                    </tr>     
                    @endforeach
                </tbody>   
            </table>
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Microhotel</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>


  <!-- Template Main JS File -->
  <script src="{{ asset('template/assets/js/main.js') }}"></script>
  

  <script>
  // Listen for the confirm button click
  $('#confirmDeactivateBtn').click(function() {
    // Submit the form
    $('#deactivateForm').submit();
  });
  
  // Reset the form when the modal is closed
  $('#deactivateModal').on('hidden.bs.modal', function () {
    $('#deactivateForm')[0].reset();
  });
</script>

</body>


</html>