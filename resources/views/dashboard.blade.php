<div class="mx-2 mb-1 w-full max-w-80 mt-2">
   <div class="px-1 bg-white text-black">Annecy Lake Temperature 🌡</div>
      @if ($temp >= 22)
         <p  class="px-1 bg-green-300 text-black mt-3">{{ $temp }} °C 🥳</p>
      @elseif ($temp >= 20)
         <p  class="px-1 bg-green-200 text-black mt-3">{{ $temp }} °C 😎</p>
      @elseif ($temp >= 18)
         <p  class="px-1 bg-blue-300 text-black mt-3">{{ $temp }} °C 💪🏻</p>
      @else
         <p  class="px-1 bg-red-300 text-black mt-3">{{ $temp }} °C 🥶</p>
      @endif
   </div>
</div>