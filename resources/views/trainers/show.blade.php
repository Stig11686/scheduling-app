<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 {{$trainer->name}}
             </h2>
        </div>
     </x-slot>
      <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <!-- Replace with your content -->
          <div class="px-4 py-4 sm:px-0">
            <div class="h-96 rounded-lg border-4 border-dashed border-gray-200">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="col-span-2 relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400 overflow-x-scroll ">
                     <div class="min-w-full flex-1">
                       <span class="absolute inset-0" aria-hidden="true"></span>
                          <h2 class="text-lg text-blue-500 font-medium text-gray-900">Upcoming Sessions</h2>
                            @if(count($sessions) > 0)
                                <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                   <tr>
                                      <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">Date</th>
                                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Session Name</th>
                                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Zoom Link</th>
                                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Cohort</th>
                                   </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($sessions as $session)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $session->date }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $session->session_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><a href="{{ $session->zoom_room_link }}">{{  $session->zoom_room_link }}</a></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $session->cohort_name}}</td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @else
                                <p><strong>No upcoming sessions</strong>
                            @endif


                      </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /End replace -->
        </div>
      </main>

</x-app-layout>


