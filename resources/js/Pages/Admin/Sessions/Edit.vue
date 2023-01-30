<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                :title="$page.props.session.name"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <form class="space-y-8 divide-y divide-gray-200" method="PUT" :action="route('sessions.update', $page.props.session)">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit {{$page.props.session.name}} </h3>
                                    <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> Session Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="name" id="name" :value="$page.props.session.name"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700"> Review Date </label>
                                        <div class="mt-1">
                                            <input id="review_date" name="review_date" type="date" :value="$page.props.session.review_date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                         </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="review_status" class="block text-sm font-medium text-gray-700"> Review Status </label>
                                        <div class="mt-1">
                                            <input type="text" name="review_status" id="review_status" :value="$page.props.session.review_status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="slides" class="block text-sm font-medium text-gray-700"> Link to Slides </label>
                                        <div class="mt-1">
                                            <input type="text" name="slides" id="slides" :value="$page.props.session.slides" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="vat_num" class="block text-sm font-medium text-gray-700"> Link to Trainer Notes. </label>
                                        <div class="mt-1">
                                            <input type="text" name="trainer_notes" id="trainer_notes" :value="$page.props.session.trainer_notes" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
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

                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
