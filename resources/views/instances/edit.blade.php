<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-200 text-white">{{$error}}</div>
                        @endforeach
                    @endif
                    <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{route('currentcourses.update', $instance[0]->id)}}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="instance_id" id="instance_id" value="{{ $instance[0]->id}}" />
                        <input type="hidden" name="cohort_id" id="cohort_id" value="{{ $instance[0]->cohort->id}}" />
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Add Sessions to {{ $instance[0]->course->name }} - {{ $instance[0]->cohort->name }} </h3>
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                     @foreach($sessions as $session)
                                    <div class="col-span-2">
                                        <input
                                            type="checkbox"
                                            name="session_id[]"
                                            for="{{ $session->id }}"
                                            id={{ $session->id }}
                                            value="{{ $session->id }}"
                                            @foreach($session_data as $data)
                                                @if($data->instance_id === $instance[0]->id && $data->session_id === $session->id)
                                                    checked
                                                @endif
                                            @endforeach
                                        />
                                        <label for="{{$session->id}}">{{ $session->name}}, {{ $session->id }} </label>
                                    </div>
                                @endforeach
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
