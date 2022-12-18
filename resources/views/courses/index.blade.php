<x-app-layout>

<x-slot name="header">
   <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
        <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center">
        <a href="{{route('courses.create')}}">
            <span class="text-white text-xl">+</span>
         </a>
      </div>
   </div>
</x-slot>

<x-slot name="slot">
   <div class="max-w-7xl mx-auto">
   <ul role="list" class="divide-y divide-gray-200">
      @foreach($courses as $course)
         <li>
            <div class="px-4 py-4 sm:px-6">
               <div class="flex items-center justify-between">
                  <p class="text-sm font-medium text-indigo-600 truncate">{{$course->name}}</p>
                  <div class="ml-2 flex-shrink-0 flex">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><a href="{{ route('courses.edit', $course) }}">Edit Course</a></span>
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                     <form method="POST" action="{{ route('courses.destroy', $course) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Delete Course</button>
                     </form>
                  </div>
               </div>
               <div class="mt-2 sm:flex sm:justify-between">
                  <div class="sm:flex">
                  <p class="flex items-center text-sm text-gray-500">
                     <!-- Heroicon name: solid/users -->
                     <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                     </svg>
                     No. Of users in course
                  </p>
                  <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                     <!-- Heroicon name: solid/location-marker -->
                     <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                     </svg>
                    Zoom Room?
                  </p>
                  </div>
                  <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                  <!-- Heroicon name: solid/calendar -->
                  <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                     <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                  </svg>
                  </div>
               </div>
            </div>
            </a>
         </li>
      @endforeach
   </ul>
   </div>
</x-slot>



</x-app-layout>