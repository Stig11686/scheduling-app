<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('sessions.store') }}">
                        @method('POST')
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Create Session</h3>
                                    <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> Session Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="name" id="name" value=""  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700"> Review Date </label>
                                        <div class="mt-1">
                                            <input id="review_date" name="review_date" type="date" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                         </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="review_status" class="block text-sm font-medium text-gray-700"> Review Status </label>
                                        <div class="mt-1">
                                            <input type="text" name="review_status" id="review_status" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="slides" class="block text-sm font-medium text-gray-700"> Link to Slides </label>
                                        <div class="mt-1">
                                            <input type="text" name="slides" id="slides" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="vat_num" class="block text-sm font-medium text-gray-700"> Link to Trainer Notes. </label>
                                        <div class="mt-1">
                                            <input type="text" name="trainer_notes" id="trainer_notes" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
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