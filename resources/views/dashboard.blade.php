<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <script src="https://kit.fontawesome.com/d0fec6f98b.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-KlE5+5KpSJ5eI9XDDoHkw/KRjK8Z2QgZnC7V2fz51vhP7VvUz0Bd6pCZX6bPIW8Fv+6K0/SPfgiQc6/8V7jzGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')
    <title>Reserve Dates</title>

    <style>
/* Darker background on mouse-over */
button[disabled] {
  background-color: gray;
  cursor: not-allowed;
}
button[disabled]:hover {
  background-color: gray;
}
</style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
  <x-app-layout>
    <div class="bg-cover bg-center h-[350px] max-w-full" style="background-image: url({{ asset('./images/roomtype.jpg') }});">
          <!-- Navbar -->
    <nav class="container bg-[#82e9e4] max-w-full px-3 h-[50px]">
            <!-- Flex container -->
        <div class="flex items-center justify-between mx-[40px]">
            <!-- Logo -->
            <div class="flex flex-row justify-center items-center">
                <img src="{{ asset('./images/bsba.png')}}" class="h-[50px]">
                <div class="hidden md:block">
                    <p class="text-sm">School of Business Hospitality<br> and Tourism Management</p>
                </div>
            </div>

            <div class="hidden md:flex space-x-6 items-center ">
                <a href="#" class="hover:text-[#E0C822] hover:font-medium">Home</a>
                <a href="#" class="hover:text-[#E0C822] hover:font-medium">FAQs</a>
                <a href="#" class="hover:text-[#E0C822] hover:font-medium">Contact</a>
               </div>
        </div>
    </nav>
        <div class="flex justify-center items-center">
            <h1 class="text-white font-bold text-[80px] my-[50px]">Room Types</h1>
        </div>
    </div>
    <!-- Rooms -->
    <section class="container w-[85%] mx-auto mt-10">
      <h2 class="text-2xl font-bold mb-5">Reserve Dates</h2>
      <div class="w-full flex flex-col bg-gray-200 rounded-2xl p-5">
        <div class="md:flex-row justify-center">
          <div class="w-full px-10 mx-auto">
            <form method="POST" 
            action="{{ route('store.date') }}" 
            class="grid grid-cols-1 gap-2">
              @csrf
              <div class="py-2">
                <label class="block text-gray-900 font-medium mb-2" for="check-in-date">Check-in date:</label>
                <input class="w-full border-gray-900 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                  id="check_in_date" name="check_in_date" type="date" value="{{ session('check_in_date') }}" required>

                </div>
              <div class="py-2">
                <label class="block text-gray-900 font-medium mb-2" for="check-out-date">Check-out date:</label>
                <input class="w-full border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                  id="check_out_date" name="check_out_date" type="date" value="{{ session('check_out_date') }}" required>
                
                </div>
              <div class="py-2 flex items-center">
                <label class="block text-gray-900 font-bold mr-4" for="number-of-nights">Number of Nights:</label>
                <input type="" id="number_of_nights" name="number_of_nights" value="{{ session('number_of_nights') }}"
                  class="bg-transparent pointer-events-none rounded py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:border-blue-500"
                  readonly>
              </div >
              <div class="mx-auto">
                @if ($errors->has('message'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                  {{ $errors->first('message') }}
                  <span class="absolute top-0 bottom-0 right-5 px-5 py-3">
                    {{-- <button type="button" class="close" data-bs-dismiss="alert">×</button> --}}
                  </span>
                </div>
              @endif              
            </div>
              <div class="flex justify-end my-3 ">
                <button class="bg-yellow-500 text-white active:bg-yellow-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                  type="submit" required>Continue</button>
              </div>
            </form>
          </div>
        </div>
     </div>
    </section>
    <section class="container w-[85%] mx-auto mt-10">
      <h2 class="text-2xl font-bold mb-5">Available Rooms</h2>
      <div class="w-full flex flex-col bg-gray-200 rounded-2xl p-5">
        <div class="flex item-center">
          {{-- <input type="text" name="check_in_date"value="{{ date('F j Y', strtotime(session('check_in_date'))) }}" class="w-[130px] text-center bg-transparent pointer-events-none border-none"/>
          <input type="text" name="check_out_date" value="{{ date('F j Y', strtotime(session('check_out_date'))) }}" class="w-[130px] text-center bg-transparent pointer-events-none border-none"/>
          <input type="hidden" name="number_of_nights" value="{{ session('number_of_nights') }}"/> --}}
        </div>
        <div class="bg-gray-200 rounded-2xl mx-auto flex justify-between">
          <div class="">
            <form method="POST" action="{{ route('view.room1', ['room_id' => 1]) }}" >
                @csrf
                  <input type="hidden" name="check_in_date" value="{{ session('check_in_date') }}" 
                  class="w-[113px] text-center"/>
                  <input type="hidden" name="check_out_date" value="{{ session('check_out_date') }}" 
                  class="w-[113px] text-center"/>
                  <input type="hidden" name="number_of_nights" value="{{ session('number_of_nights') }}" />
             <div class="flex justify-around items-center mx-30 m-10">
                <div class="flex justify-center items-center">
                <div class="relative">
                  <img src="{{ asset('./images/room1.jpg') }}" class="h-[350px] w-144 shadow-2xl" alt="">
                  <div class="absolute bg-white h-[200px] w-80 top-60 left-[75px] border-2 border-yellow-500 rounded-md shadow-xl p-3 flex flex-col justify-between">
                    <h1 class="text-black font-extrabold text-3xl">Room 
                      {{$room1->id}}
                    </h1> 
                    <p class="text-gray-600 text-sm">
                      {{ $room1->room_type }}
                    </p>
                    <h2 class="text-yellow-500 font-bold text-lg">
                      {{$room1->rate}}
                      / Night</h2>
                    <p class="text-sm pb-2">This Queen Bed size room provides comfort for all guests of DWCC MicroHotel</p>
                    <div class="flex justify-end">
                      <button type="submit" name="room1" value="1" {{ $isRoom1Reserved ? 'disabled' : '' }} class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-black active:bg-yellow-800 {{ $isRoom1Reserved ? 'bg-gray-400 cursor-not-allowed ' : '' }} font-semibold text-sm px-3 w-21 py-[10px] rounded shadow hover:shadow-lg outline-none focus:outline-none  ease-linear transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>&nbsp; Details
                      </button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
          <div class="bg-gray-200 pl-6">
            <form method="POST" action="{{ route('view.room2', ['room_id' => 2]) }}" >
                @csrf
                  <input type="hidden" name="check_in_date" value="{{ session('check_in_date') }}" 
                  class="w-[113px] text-center"/>
                  <input type="hidden" name="check_out_date" value="{{ session('check_out_date') }}" 
                  class="w-[113px] text-center"/>
                  <input type="hidden" name="number_of_nights" value="{{ session('number_of_nights') }}" />
                <div class="relative">
                  <img src="{{ asset('./images/room2.jpg') }}" class="h-[350px] w-144 shadow-xl" alt="">
                  <div class="absolute bg-white h-[200px] w-80 top-60 left-[75px] border-2 border-yellow-500 rounded-md shadow-xl p-3 flex flex-col justify-between">
                    <h1 class="text-black font-extrabold text-3xl">Room 
                      {{$room2->id}}
                    </h1>
                    <p class="text-gray-600 text-sm">
                      {{$room2->room_type}}
                    </p>
                    <h2 class="text-yellow-500 font-bold text-lg">
                      {{ $room2->rate }}
                      / Night</h2>
                    <p class="text-sm pb-2">This room can easily accommodate 1-3 people in comfort</p>
                    <div class="flex justify-end">
                      <button type="submit" name="room2" value="2" {{ $isRoom2Reserved ? 'disabled' : '' }} class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-black active:bg-yellow-800 {{ $isRoom2Reserved ? 'bg-gray-400 cursor-not-allowed' : '' }} font-semibold text-sm px-3 w-21 py-[10px] rounded shadow hover:shadow-lg outline-none focus:outline-none  ease-linear transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>&nbsp; Details
                      </button>                      
                   </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#a2eeea] mt-[150px]">
        <div class="max-w-[1240px] mx-auto py-16 px-4 grid lg:grid-cols-4 gap-8">
            <!-- Logo -->
            <div class="flex flex-col items-center justify-between space-y-12
            md:flex-col md:space-y-0 md:items-start">
                <!-- Logo -->
                <div>
                    <img src="{{ asset('./images/logom2.png') }}" class="h-[100px]" alt="">
                </div>
            </div>
            <div class="">
                <h1 class="font-bold text-lg w-full">MICROHOTEL</h1>
                <p class="text-sm text-gray-900">The DWCC Microhotel is a school-run hotel located inside the Divine Word College of Calapan.</p>
            </div>
            <div class="">
                <h1 class="font-bold text-lg">Contact Us</h1>
                    <p class="text-sm text-gray-900">Gov Infantado St, Calapan City, Oriental Mindoro</p>
                    <p class="text-sm text-gray-900">microhotel@dwcc.edu.ph</p>
                    <p class="text-sm text-gray-900">09123456789</p>
            </div>
            <div class="flex flex-col items-center justify-between space-y-12
            md:flex-col md:space-y-0 md:items-start">
                <!-- Logo -->
                <div>
                    <img src="{{  asset('./images/DWCCLOGO.png')}}" class="h-[100px]" alt="">
                </div>
            </div>
        </div>
        <div class="bg-[#55AFAB] flex justify-center">
            <p class="text-sm">Copyright &copy; 2023 DWCC MicroHotel</p>
        </div>
    </footer>

    <script>
      const check_in_date = document.getElementById('check_in_date');
      const check_out_date = document.getElementById('check_out_date');
      check_in_date.min = new Date().toISOString().split('T')[0];
      check_out_date.min = new Date().toISOString().split('T')[0];
    </script>

    <script>
      const checkInDate = document.getElementById('check_in_date');
      const checkOutDate = document.getElementById('check_out_date');
      const numberOfNights = document.getElementById('number_of_nights');
      checkOutDate.addEventListener('change', function() {
        const oneDay = 24 * 60 * 60 * 1000; // hours * minutes * seconds * milliseconds
        const checkIn = new Date(checkInDate.value);
        const checkOut = new Date(checkOutDate.value);
        const diffDays = Math.round(Math.abs((checkOut - checkIn) / oneDay));
        numberOfNights.value = diffDays;
      });
    </script>

</x-app-layout>
</body>
</html>