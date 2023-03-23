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
<body style="background-color: #ffffff;">
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
    
      <h2 class="text-2xl font-bold mb-5">Check Room Availability</h2>
      <hr style="border: 2px solid #E6AF2E; width: 270px;  position: relative; left: -2px; top: -20px; ">
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
              <div class="flex justify-end my-3 " >
                <button style="background-color: #E6AF2E;"class=" text-white active:bg-yellow-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                  type="submit" required>Continue</button>
              </div>
            </form>
          </div>
        </div>
     </div>
    </section>
    <section class="container w-[85%] mx-auto mt-10">
      <h2 class="text-2xl font-bold mb-5">Available Rooms</h2>
      @foreach ($rooms as $room)
      <hr style="border: 1px solid #E6AF2E; width: 188px;  position: relative; left: -2px; top: -20px; ">
       <form method="POST" action="{{ route('view.room', ['room_id' => $room->id]) }}" >
          @csrf
          <input type="hidden" name="check_in_date" value="{{ session('check_in_date') }}" 
          class="w-[113px] text-center"/>
          <input type="hidden" name="check_out_date" value="{{ session('check_out_date') }}" 
          class="w-[113px] text-center"/>
          <input type="hidden" name="number_of_nights" value="{{ session('number_of_nights') }}" />
        @endforeach
        <div class="flex flex-wrap justify-center rounded-lg bg-gray-200">
          @foreach ($rooms as $room)
            <div class="max-w-sm rounded overflow-hidden shadow-lg m-10 bg-white">
              <img class="w-full" src="{{ asset('./images/room1.jpg') }}" alt="Room Image">
            <div class="">
              <div class="px-6 py-4">
                <div>
                  <div class="text-black font-extrabold text-lg">Room {{$room->id}}</div>
                  <p class="text-gray-700 text-base">
                    {{$room->room_type}}
                  </p>
                  <strong><p style="color: #E6AF2E;"><strong>
                    {{$room->rate}} / Night
                  </p>
                  <p class="text-gray-700 text-base">
                    This Queen Bed size room provides comfort for all guests of DWCC MicroHotel
                  </p>
                </div>
              </div>
              </div>  
              <div class="px-6 py-2">
                <div class="flex justify-end">
                  <button type="submit" name="room2" value="{{ $room->id }}" 
                  {{-- {{ $isRoom2Reserved ? 'disabled' : '' }}    --}}
                  class="inline-flex items-center  hover:bg-yellow-600 text-black active:bg-yellow-800 
                  {{-- {{ $isRoom2Reserved ? 'bg-gray-400 cursor-not-allowed' : '' }}  --}}
                  font-semibold text-sm px-3 w-21 py-[10px] rounded shadow hover:shadow-lg outline-none focus:outline-none  ease-linear transition-all duration-150" style="background-color: #E6AF2E; color: #ffffff;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>&nbsp; DETAILS
                  </button>                      
              </div>
              </div>
            </div>
          @endforeach
      </div>
    </form>
    </section>  
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