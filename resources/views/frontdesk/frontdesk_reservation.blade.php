<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  @vite('resources/css/app.css')

  <title>Frontdesk Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script data-require="jquery@3.1.1" data-semver="3.1.1"
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Favicons -->
  <link href="{{ asset('template/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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
  <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"
    integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous">
  </script>
  {{-- Script for Select Room_types --}}
 

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
            <!-- <span class="d-none d-md-block dropdown-toggle ps-2">Frontdesk</span> -->
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('frontdesk')->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Frontdesk</h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('frontdesk.logout') }}">
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
        <a class="nav-link collapsed" href="{{ route ('frontdesk.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link nav-link-icon " href="{{ route('frontdesk.reservation') }}">
          <i class="fa-solid fa-bell icon-nav"></i>
          <span>Reservation</span>
        </a>
      </li><!-- End Manage Rooms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('frontdesk.payment') }}">
          <i class="fa-regular fa-credit-card icon-nav"></i>
          <span>Payment</span>
        </a>
      </li><!-- End Booking History Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('frontdesk.bookingdetails') }}">
          <i class="fa-solid fa-book-open-reader icon-nav"></i>
          <span>Booking Details</span>
        </a>

      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('frontdesk.reports') }}">
          <i class="fa-solid fa-file-lines icon-nav"></i>
          <span>Reports</span>
        </a>
      </li><!-- End Reports Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reservation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Reservation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <hr style="border-top: 2px solid #3C4048;position: relative; left: 8px;">
    <section class="col-md-11 mx-auto">
      {{-- <div class="justify-between mx-[50px]">   --}}
              @if(session()->has('error'))
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                <strong>{{ session('error') }}</strong>
            </div>
            @endif
            @if(session()->has('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                  <strong>{{ session('success') }}</strong>
              </div>
          @endif
      {{-- </div>  --}}
      <div class="container  px-4 sm:px-6 lg:px-8">
          <!-- Flex container -->
          <div class="justify-between mx-[50px]">
            <!-- Room Info -->
            <form method="POST" action="{{ route('frontdesk.reservation.save') }}" >
              <div class="mx-auto mt-8" style="width:1000px;  position: relative; left: -110px;">
                <div class="bg-white rounded-lg shadow-md border-2 w-full " style="height: 500px;">
                  <div class="border-b-2 border-gray-300 px-4 py-3">
                    <h3 class="text- sm:text-2xl font-semibold">Room Information</h3>
                  </div>
                  <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                    <div class="flex flex-col lg:flex-row justify-center">
                      <div class="mx-4 md:mx-4 py-3" style="position:relative; left: -250px; ">
                        <label class="" for="room_type">Room Type:</label><br>
                        {{-- <select class="w-full md:w-[475px]" name="room_type" id="room_type"
                          value="{{ old('room_type') }}" placeholder="Single Size" >
                          <option value="single-size" {{ old('room_type') == 'Single' ? 'selected' : '' }}>Single Size
                          </option>
                          <option value="queen-size-bed" {{ old('room_type') == 'Queen' ? 'selected' : '' }}>Queen Size
                          </option>
                        </select> --}}
                        <select class="w-full md:w-[475px]" name="room_type" id="room_type">
                          @foreach ($room_type as $roomType)
                              <option value="{{ $roomType }}" {{ old('room_type') == $roomType ? 'selected' : '' }}>
                                  {{ ucfirst($roomType) }} Size
                              </option>
                          @endforeach
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                    <div class="flex flex-col lg:flex-row justify-center">
                      <div class="mx-4 md:mx-4 py-3" style="position:relative; left: 250px; top: -145px; ">
                        <label class="" for="room_no">Room No:</label><br>
                        <input class="first-letter:w-full md:w-[475px] py-1.5 border-2 text-center border-gray-900" name="room_no" id="room_no" value="{{ old('room_no') }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                    <div class="flex flex-col lg:flex-row justify-center">
                      <div class="mx-4 md:mx-4 py-3" style="position:relative; left: 250px; top: -145px; ">
                        <div class="grid grid-cols-1 ">
                          <div class=" py-2">
                            <label class="" for="room_no" style="position:relative; left: -265px; top: -65px;">Check-in
                              Date:</label><br>
                            <input
                              class="w-full border-gray-900  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                              id="check_in_date" name="check_in_date" type="date"
                              style="width: 475px;height:50px;position:relative; left: -265px; top: -65px;border-color: gray;"
                              value="{{ old('check_in_date') }}">
                              {{-- {{ $roomNo }} --}}
                            {{-- <x-input-error :messages="$errors->get('check_in_date')" class="mt-2" /> --}}
                          </div>
                        </div>
                      </div>
                      <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                        <div class="flex flex-col lg:flex-row justify-center">
                          <div class="mx-4 md:mx-4 py-3" style="position:relative; left: 250px; top: -145px; ">
                            <div class="grid grid-cols-1 ">
                              <div class=" py-2">
                                <label class="" for="room_no"
                                  style="position:relative; left: -265px; top: -65px;">Check-out Date:</label><br>
                                <input
                                  class="w-full border-gray-900  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                                  id="check_out_date" name="check_out_date" type="date"
                                  style="width: 475px;height:50px;position:relative; left: -265px; top: -65px; border-color: gray"
                                  value="{{ old('check_out_date') }}">
                                {{-- <x-input-error :messages="$errors->get('check_out_date')" class="mt-2" /> --}}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 mt-1">
                <div class=" py-2 flex items-center">
                  <label style="position:relative; top: -80px; left: -95px;"
                    class="block text-gray-900 font-medium mr-4" for="number-of-nights">Number of Night/s:</label>
                  <input type="" id="number_of_nights" name="number_of_nights"
                    style="font-weight: bold; position: relative; top: -80px; left: -95px;"
                    value="{{ old('number_of_nights') }}"
                    class="bg-transparent pointer-events-none rounded py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:border-blue-500"
                    readonly>

                  @if ($errors->any())
                  <div class="alert alert-danger font-sm text-center">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>
              </div>
              <div class="py-2">
                <p style="position: relative; top: -150px; left: -95px; top: -285px;" class="text-medium font-semibold">
                  Number of Guest</p>
                <div class="flex items-center justify-center">
                  <a style="position: relative; top: -150px; left: 215px; top: -285px;"
                    class="bg-gray-100 hover:bg-gray-400 text-gray-700 px-2 py-2 rounded-r shadow-md transition duration-300 ease-in-out cursor-pointer"
                    onclick="add('guest_num')">+</a>
                  <input style="position: relative; top: -150px; left: -225px; top: -285px; width: 410px;" readonly
                    type="number" id="guest_num" name="guest_num" value="1" min="1"
                    class="w-[200px] text-center text-gray-700 bg-white py-2">
                  <a style="position: relative; top: -150px; left: -670px; top: -285px;"
                    class="bg-gray-100 hover:bg-gray-400 text-gray-700 px-2 py-2 rounded-l shadow-md transition duration-300 ease-in-out cursor-pointer"
                    onclick="subtract('guest_num')">-</a>
                </div>
              </div>
              <div class="py-2">
                <p style="position: relative; top: -150px; left: 400px; top: -385px;" class="text-medium font-semibold">
                  Extra Bed</p>
                <div class="flex items-center justify-center mt-2">
                  <a style="position: relative; top: -150px; left: 695px; top: -385px;"
                    class="bg-gray-100 hover:bg-gray-400 text-gray-700 px-2 py-2 rounded-r shadow-md transition duration-300 ease-in-out cursor-pointer"
                    onclick="add('extra_bed')">+</a>
                  <input style="position: relative; top: -150px; left: 260px; top: -386px; width: 410px;" readonly
                    type="number" id="extra_bed" name="extra_bed" value="1" min="1"
                    class="w-[200px] text-center text-gray-700 bg-white py-2">
                  <a style="position: relative; top: -150px; left: -180px; top: -385px;"
                    class="bg-gray-100 hover:bg-gray-400 text-gray-700 px-2 py-2 rounded-l shadow-md transition duration-300 ease-in-out cursor-pointer"
                    onclick="subtract('extra_bed')">-</a>
                </div>
              </div>

             <!-- Guest Info -->
            <div class="bg-white rounded-lg border-2 shadow-md w-full pb-4"
                style="width:1000px; position: relative; left: -110px; top: -210px;">
                <div class="border-b-2 border-gray-300 px-4 py-3">
                  <h3 class="text- sm:text-2xl font-semibold">Guest Information</h3>
                </div>
                <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                  <div class="flex flex-col lg:flex-row justify-center">
                    <div class="mx-4 md:mx-4 py-3" style="position:relative; left: 35px; height: 10px;">
                      <label class="" for="salutation">Salutation:</label>
                      <select class="w-full md:w-[125px]" name="salutation" id="salutation"
                        value="{{ old('salutation') }}" placeholder="Ms.">
                        <option value="Ms." {{ old('salutation') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                        <option value="Mrs." {{ old('salutation') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                        <option value="Mr." {{ old('salutation') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                      </select>
                    </div>
                    <div class="px-4 md:px-6 py-3" style="position:relative; left: 10px;">
                      <label class="" for="fullname">Full Name:&nbsp;<span
                          class="text-red-700 font-bold">*</span></label>
                      <input type="text" class="w-full md:w-[400px]" name="first_name" id="first_name"
                        value="{{ old('first_name') }}" placeholder="First Name" required>
                    </div>
                    <div class="px-4 md:px-6 py-3" style="position:relative; left: -18px;">
                      <label class="" for="lastname"></label>
                      <input type="text" class="w-full md:w-[400px]" name="last_name" id="last_name"
                        value="{{ old('last_name') }}" placeholder="Last Name" required>
                    </div>
                  </div>
                  <div class="mx-4 sm:mx-10">
                    <label for="companyName">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="w-full"
                      value="{{ old('company_name') }}" placeholder="Company Name">
                  </div>
                  <div class="mx-4 sm:mx-10">
                    <label for="Address">Address&nbsp;<span class="text-red-700 font-bold">*</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Address"
                      class="w-full" required>
                  </div>
                  <div class="mx-4 sm:mx-10">
                    <label for="address">Phone Number&nbsp;<span class="text-red-700 font-bold">*</label><br>
                    <input type="number" style="width: 950px;" name="phone_number" id="phone_number"
                      value="{{ old('phone_number') }}" class="w-full sm:w-[200px]" placeholder="+63" required>
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                  </div>
                </div>
              </div>
              <!-- Payment Method -->
              <div class="mx-auto mt-8" style="width:1000px; position: relative; left: -110px; top: -210px;">
                <div class="bg-white rounded-lg shadow-md border-2 w-full ">
                  <div class="border-b-2 border-gray-300 px-4 py-3">
                    <h3 class="text- sm:text-2xl font-semibold">Payment Method</h3>
                  </div>
                  <div class="mx-4 sm:mx-10 pt-5 pb-10">
                    <div class="py-2">
                      <input class="mr-2" type="radio" name="payment_method" id="cash" value="Cash" required>
                      <label for="payment_method_cash">Cash</label>
                    </div>
                    <div class="py-2">
                      <input class="mr-2" type="radio" name="payment_method" id="department_charge"
                        value="Department Charge" required>
                      <label for="payment_method_department_charge">Department Charge</label>
                    </div>
                    <div class=" mx-[100px] bg-slate-300 border-1 border-gray-400  px-3 rounded-sm py-3"
                      id="department_charge_options" style="display:none">
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_it"
                          value="School of Information Technology">
                        <label for="department_it">School of Information Technology</label>
                      </div>
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_edu"
                          value="School of Education">
                        <label for="department_edu">School of Education</label>
                      </div>
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_bhmt"
                          value="School of Business and Hospitality and Tourism Management">
                        <label for="department_bhmt">School of Business and Hospitality and Tourism Management</label>
                      </div>
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_acc"
                          value="School of Accountancy">
                        <label for="department_acc">School of Accountancy</label>
                      </div>
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_eng"
                          value="School of Engineering and Architechture and Fine Arts">
                        <label for="department_eng">School of Engineering and Architechture and Fine Arts</label>
                      </div>
                      <div class="py-2">
                        <input class="mr-2" type="radio" name="department" id="department_lacj"
                          value="School of Liberal Arts and Criminal Justice">
                        <label for="department_lacj">School of Liberal Arts and Criminal Justice</label>
                      </div>
                    </div>
                  </div> 
            </div>
          <div class="flex justify-end mt-10">
            <button type="submit" class="btn btn-primary" style="background-color: #E0C822 " >
            Save
          </button>
            <!-- <button  class="bg-yellow-500 text-white active:bg-yellow-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Continue</button> -->
            <button type="submit" class="btn btn-primary" style="background-color: #E0C822 " data-bs-toggle="modal"
              data-bs-target="#modalDialogScrollable">
              continue
            </button>
          </form>
            {{-- <!-- Modal -->
            <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Room Booking</h4>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      {{-- </div> --}}
      </div> 
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>DWCC Microhotel</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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
  {{-- Public Js File --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/frontdeskReservation.js') }}"></script>
  <script>
      $(document).ready(function() {
        $('#room_type').on('change', function() {
            var roomType = $(this).val();
            $.ajax({
                url: '{{ route("frontdesk.reservation.create") }}',
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'room_type': roomType
                },
                success: function(response) {
                    if (response.room_id) {
                        $('#room_no').val(response.room_id);
                    } else {
                        console.log('Room ID not found in response');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
  </script>
</body>
</html>