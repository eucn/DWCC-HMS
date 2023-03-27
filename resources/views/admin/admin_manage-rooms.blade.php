<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  @vite('resources/css/app.css')

  <title>Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('template/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

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
        <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link nav-link-icon" href="{{ route('admin.room.index') }}">
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
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-user icon-nav"></i><span>Accounts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Frontdesk</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Guest</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="fa-regular fa-file-lines icon-nav"></i>
          <span>Reports</span>
        </a>
      </li><!-- End Reports Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Rooms</h1><br>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Manage Rooms</li><br>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <div class="d-flex justify-content-between mb-3">
            <!-- <div class="ml-auto">
                <a class="btn btn-primary" onclick="openModal()">Add New</a>
            </div> -->
            <!-- Button trigger modal -->
            <div class="ml-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>&nbsp Add New</button>
            </div>
          </div>

          <hr style="border-top: 2px solid #3C4048;position: relative; left: 8px;">

          <!-- Modal -->
          <div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: #51bdb8;">Add New Room</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-2">
                        <label>Room Number</label>
                        <input class="form-control" type="number" name="room_number">
                        <x-input-error :messages="$errors->get('room_number')"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Room Type</label>
                        <input class="form-control" type="text" name="room_type">
                        <x-input-error :messages="$errors->get('room_type')"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <input class="form-control" type="text" name="room_description">
                        <x-input-error :messages="$errors->get('room_description')"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Maximum Room Capacity</label>
                        <input class="form-control" type="number" name="max_capacity">
                        <x-input-error :messages="$errors->get('max_capacity')"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Amenities</label>
                        <input class="form-control" type="text" name="amenities">
                        <x-input-error :messages="$errors->get('amenities')"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Status</label>
                        <input class="form-control" type="text" name="status">
                        <x-input-error :messages="$errors->get('status')"/>
                        <!-- <select class="form-control" name="status">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select> -->
                    </div>
                    <div class="form-group mb-2">
                        <label>Rate</label>
                        <input class="form-control" type="number" name="rate">
                        <x-input-error :messages="$errors->get('rate')"/>
                    </div>
                    <div class="form-group">
														<label for="image" class="col-form-label" style=" font-weight: 500;">Image:</label>
														<input type="file" name="photos" class="form-control" id="photos">
												
                        <x-input-error :messages="$errors->get('photos')"/>
                    </div>
                    <button type="submit" style="position: relative; left: 400px;" class="btn btn-primary">Save</button>
                    <button type="reset" style="position: relative; left: 250px; background-color: #7c7c7c; border: none;" class="btn btn-primary">Cancel</button>
                </form>
            </div>
    </div>
    </div>
</div>
          <!-- <div class="alert alert-success" role="alert">
            The record has been successfully added.
          </div> -->
          @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
              <p>{{ $message }}</p>
            </div>
          @endif

            <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="d-flex justify-content-between mb-3">
              <div class="row mt-3">
                <div class="d-flex align-items-center">
                  <b><label for="records_per_page" class="col-auto mr-2"
                      style="position: relative; top: 2px; right: -3px;color:#434242;">Show</label></b>
                  <select name="records_per_page" id="records_per_page" class="form-control mr-2" style="position: relative; left:-15px;"
                    onchange="window.location.href = this.value;">
                    <option value="{{ url()->current() }}?records_per_page=10" 'selected' : '' }}>10</option>
                    <option value="{{ url()->current() }}?records_per_page=25" 'selected' : '' }}>25</option>
                    <option value="{{ url()->current() }}?records_per_page=50" 'selected' : '' }}>50</option>
                    <option value="{{ url()->current() }}?records_per_page=100" 'selected' : '' }}>100</option>
                    {{-- <option value="100">10</option>
                    <option value="100">25</option>
                    <option value="100">50</option>
                    <option value="100">100</option> --}}
                  </select>
                
                  <b>
                    <p style="position: relative; top: 7px; left: -20px;color:#434242;">entries</p>
                  </b>
                </div>
                <div class="">
                </div>
              </div>
            </div>
          </div><!-- End Left side columns -->
            <!-- <div class="ml-auto">
                <form action="{{ route('admin.room.create') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div> -->
          </div>

            <table class="table table-condensed table-sm table-bordered">   
                <thead class="bg-[#51bdb8] text-white">   
                    <tr style="text-align:center">   
                        <th scope="col">Room No.</th>
                        <th scope="col">Room Type</th>
                        <th scope="col" style="width: 200px;">Description</th>
                        <th scope="col">Maximum Room Capacity</th>
                        <th scope="col">Amenities</th>
                        <th scope="col">Status</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Photos</th>
                        <th scope="col" >Action</th>
                    </tr>   
                </thead>   
                <tbody>   
                  @foreach($rooms as $roomData)
                    <tr style="text-align:center">
                        <td>{{ $roomData-> room_number }}</td>
                        <td>{{ $roomData-> room_type }}</td>
                        <td>{{ substr($roomData->room_description, 0, 50) }}...</td>
                        <td>{{ $roomData-> max_capacity }}</td>
                        <td>{{ $roomData-> amenities }}</td>
                        <td>{{ $roomData-> status }}</td>
                        <td>{{ $roomData-> rate }}</td>
                        <td>
                          <img src="{{ asset($roomData->photos) }}" alt="Room" width="70px" height="70px">                 
                        </td>
                        <td style="width: 150px;" >
                          <form action="{{ route('admin.room.create') }}" method="POST">
                          
                          <button type="button" class="btn btn-primary" style="position:relative;left: -25px; top: 20px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $roomData->id }}">
                          <i class="fa-regular fa-pen-to-square"></i>
                          </button>
                          <button type="button" class="btn btn-danger" style="position:relative;left: -25px; top: 20px;" data-bs-toggle="modal" data-bs-target="#delete{{ $roomData->id }}">
                          <i class="fa-solid fa-trash"></i>
                          </button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $roomData->id }}" tabindex="-1" aria-labelledby="editModal{{ $roomData->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="'admin.room.update">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color: #51bdb8;" id="editModal{{ $roomData->room_number }}Label">Edit Room</h5>
                                            <button type="button" class="btn-close" style="color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                  
                                            <div class="form-group">
                                                <label for="name" style="position: relative; left: -175px;">Room Number</label><br>
                                                <input type="text"  style="position: relative; left: -5px; width: 450px;" name="name" id="name" value="{{ $roomData->room_number }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="room_description" style="position: relative; left: -188px; ">Description</label>
                                                <textarea name="description"  class="form-control">{{ $roomData->room_description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="room_type"  style="position: relative; left: -188px; ">Room Type</label>
                                                <input type="text" name="room_type" class="form-control" value="{{ $roomData->room_type }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="max_capacity"  style="position: relative; left: -165px; ">Maximum Capacity</label>
                                                <input type="text" name="max_capacity" class="form-control" value="{{ $roomData->max_capacity }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="amenities"  style="position: relative; left: -190px; ">Amenities</label>
                                                <input type="text" name="amenities" class="form-control" value="{{ $roomData->amenities }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="status"  style="position: relative; left: -210px; ">Status</label>
                                                <input type="text" name="status" class="form-control" value="{{ $roomData->status }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="rate"  style="position: relative; left: -210px; ">Rate</label>
                                                <input type="text" name="rate" class="form-control" value="{{ $roomData->rate }}">
                                            </div>
                                          
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                  </div>
                              </div>
                            </div> ``



                        <!-- <form action="{{ route('admin.room.destroy', $roomData->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="position:relative;left: 28px; top: -20px;" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>      
                        </td>
                    </tr> -->
                    <div class="modal fade" id="delete{{ $roomData->id }}" id="view_modal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content" style="height: 230px;">
                    <div class="modal-header">
                      <button type="button" style="position:relative; left: 350px; color: red;" class="close"
                        data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" style="position:relative; left: -190px; color:#51bdb8;">Confirm Delete
                      </h4>
                    </div>
                    <form  action="{{ route('admin.room.destroy',  $roomData->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <input id="id" name="id">
                        <strong>
                          <h4 class="text-center">Are you sure you want to Delete this Room?
                        </strong></h4>
                      </div>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"class="btn btn-primary">Yes,Continue </button>
                      </div>
                    </form>
                  </div>
                </div>
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

  <!-- Template Main JS File -->
  <script src="{{ asset('template/assets/js/main.js') }}"></script>

  <<script>
  $(document).ready(function() {
    $('#saveButton').click(function() {
      var recordId = $('#exampleModal').data('id');
      var updatedValue = $('#updatedValue').val();
      
      $.ajax({
        type: 'PUT',
        url: '/records/' + recordId,
        data: {
          _token: '{{ csrf_token() }}',
          value: updatedValue
        },
        success: function(data) {
          // Handle success response
          $('#exampleModal').modal('hide');
          location.reload();
        },
        error: function() {
          // Handle error response
        }
      });
    });
  });
</script>
</script>

</body>

</html>