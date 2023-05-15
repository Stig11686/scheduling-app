<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import Accordion from '@/Components/Accordion.vue';

    import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                :title="`${$page.props.cohort.name} Users List`">
            </AdminPageHeader>
        </template>
        <template #default>
            <AdminDataDisplay>
                <template #data>
                        <ul v-for="item in $page.props.cohort.learners" :key="item.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <Link :href="route('users.show', item.user.id)">
                                    <p class="text-sm font-medium text-indigo-600 truncate">{{item.user.name}}</p>
                                    </Link>
                                    <div class="ml-2 flex-shrink-0 flex">
                                    <Link :href="route('users.edit', item.user.id)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit User</Link>
                                        <button @click.prevent="deleteCourse(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Delete User
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                    <!-- <p class="flex items-center text-sm text-gray-500"> -->
                                        <!-- Heroicon name: solid/users -->
                                        <!-- <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>

                                    </p> -->
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">

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
