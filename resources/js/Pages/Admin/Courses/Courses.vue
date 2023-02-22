<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import Pagination from '@/Components/Pagination.vue';

    const form = useForm();

    const deleteCourse = (item) => {
        form.delete(route('courses.destroy', item));
    }
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="Courses"
                href="courses.create"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <ul v-for="item in $page.props.courses.data" :key="item.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">{{item.name}}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                    <Link :href="route('courses.edit', item.id)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit Course</Link>
                                        <button @click.prevent="deleteCourse(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Delete Course
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
                                        No. Of users in course
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

                            </li>
                    </ul>
                    <Pagination class="mt-6" :links="$page.props.courses.links" />

                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
