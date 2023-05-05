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
                :title="$page.props.course.name">
            </AdminPageHeader>
        </template>
        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <ul v-for="item in $page.props.instances" :key="item.id" role="list" class="divide-y divide-gray-200">
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <Link :href="route('cohorts.show', item.cohort.id)">
                            <p class="text-sm font-medium text-indigo-600 truncate">{{item.cohort.name}}</p>
                            </Link>
                            <div class="ml-2 flex-shrink-0 flex">
                            <Link :href="route('cohorts.edit', item.cohort.id)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit Cohort</Link>
                                <button @click.prevent="deleteCourse(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Delete Cohort
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                            <p class="flex items-center text-sm text-gray-500">
                                <!-- Heroicon name: solid/users -->
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                {{item.cohort.learners_count}} Learners in this Cohort
                            </p>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                            <!-- Heroicon name: solid/calendar -->
                            <Link class="flex" href="#">
                                Schedule
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                            </div>
                        </div>
                        </div>

                    </li>
                </ul>
                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
