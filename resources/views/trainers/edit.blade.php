<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $trainer->name }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('trainers.update', $trainer) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Trainer</h3>
                                    <p class="mt-1 text-sm text-gray-500">Some of this information will be displayed publicly so be careful what you share.</p>
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="name" id="name" value="{{$trainer->name}}"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                        <div class="mt-1">
                                            <input id="email" name="email" type="text" value="{{$trainer->email}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                         </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="phone" class="block text-sm font-medium text-gray-700"> Phone Number </label>
                                        <div class="mt-1">
                                            <input type="text" name="phone" id="phone" value="{{$trainer->phone}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="profile_pic" class="block text-sm font-medium text-gray-700"> Upload Profile Picture </label>
                                        <div class="mt-1">
                                            <input type="file" name="profile_pic" id="profile_pic" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="status" class="block text-sm font-medium text-gray-700">Is Active</label>
                                        <div class="mt-1">
                                            <input type="checkbox" name="status" id="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md" <?php echo ($trainer->status === 1 ? 'checked' : ''); ?>>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="has_dbs" class="block text-sm font-medium text-gray-700"> Has DBS </label>
                                        <div class="mt-1">
                                            <input type="checkbox" name="has_dbs" id="has_dbs" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md" <?php echo ($trainer->has_dbs === 1 ? 'checked' : ''); ?>>
                                        </div>
                                    </div>

                                    <!-- TO DO - Play around with these dates. You may need a bit of JS/JQuery to display the dates in different format as HTML5 only supports Y-m-d -->

                                    <fieldset id="dbsAdditionalQuestions" class="sm:col-span-6 divide-grey-200 py-6 space-y-8">
                                        <div class="sm:col-span-6">
                                            <label for="dbs_date" class="block text-sm font-medium text-gray-700"> DBS Date Active </label>
                                            <div class="mt-1">
                                                <input type="date" name="dbs_date" id="dbs_date" value="<?php echo ($trainer->dbs_date ? $trainer->dbs_date : '') ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="dbs_date" class="block text-sm font-medium text-gray-700"> DBS Renewal Date </label>
                                            <div class="mt-1">
                                                <input type="date" name="dbs_renewal_date" id="dbs_renewal_date" value="<?php echo ($trainer->dbs_date ? date('Y-m-d', strtotime("+12 months", strtotime($trainer->dbs_date))) : '') ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="dbs_cert_path" class="block text-sm font-medium text-gray-700"> DBS Certificate Upload </label>
                                            <div class="mt-1">
                                                <input type="file" name="dbs_cert_path" id="dbs_cert_path" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="sm:col-span-6">
                                        <label for="has_completed_mandatory_training" class="block text-sm font-medium text-gray-700"> Mandatory Training Complete </label>
                                        <div class="mt-1">
                                            <input type="checkbox" name="has_completed_mandatory_training" id="has_completed_mandatory_training" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md" <?php echo ($trainer->has_completed_mandatory_training ? 'checked' : '') ?>>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="has_completed_mandatory_training" class="block text-sm font-medium text-gray-700"> Upload Mandatory Training Certificates </label>
                                        <div class="mt-1">
                                            <input type="file" multiple name="mandatory_training_cert_1[]" id="has_completed_mandatory_training" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
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


<script>
    const hasDBSCheckbox = document.querySelector('#has_dbs');
    const dbsConditionalQuestions = document.querySelector('#dbsAdditionalQuestions');
    const dbsDateField = document.getElementById('dbs_date');
    const dbsRenewalDateField = document.getElementById('dbs_renewal_date');

    document.addEventListener('change', function(e) {
        if(!hasDBSCheckbox.checked){
            dbsConditionalQuestions.classList.add('hidden');
            dbsDateField.value = null;
            dbsRenewalDateField.value = null
        } else {
            dbsConditionalQuestions.classList.remove('hidden')
        }

    })

</script>