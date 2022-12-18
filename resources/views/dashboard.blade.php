<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white space-y-2 overflow-hidden shadow-sm sm:rounded-lg">
                <x-dashboard-card>
                    <x-slot name="title">
                    Courses
                    </x-slot>
                    <x-slot name="content">
                    @foreach ($courses as $course)
                    <p class="">
                        {{$course->name}}
                    </p>
                    @endforeach
                    </x-slot>
                </x-dashboard-card>



            </div>
        </div>
    </div>
</x-app-layout>
