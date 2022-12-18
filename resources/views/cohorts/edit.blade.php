<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Cohort') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('cohorts.update', $cohort) }}">
                        @method('PUT')
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit {{$cohort->name}}</h3>
                                    <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> Cohort Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="name" id="name" value="{{$cohort->name}}"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="places" class="block text-sm font-medium text-gray-700"> Cohort Total Places </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="places" id="places" value="{{$cohort->places}}"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="start_date" class="block text-sm font-medium text-gray-700"> Cohort Start Date </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="date" name="start_date" id="start_date" value="{{$cohort->start_date}}"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="end_date" class="block text-sm font-medium text-gray-700"> Cohort End Date </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="date" name="end_date" id="end_date" value="{{$cohort->end_date}}"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-5 pt-5">
                            <div class="flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>