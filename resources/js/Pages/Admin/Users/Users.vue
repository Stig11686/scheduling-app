<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm();

const isAdmin = (user) => {
    const roles = user.roles.map(x => x.name);
    return roles.includes('super-admin') || roles.includes('tcg-admin');
}

const deleteUser = (user) => {
    form.delete(route('users.destroy', user));
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="User Management"
                href="users.create"
            />
        </template>
        <AdminDataDisplay>
            <template #data>
                //TODO - ADD FILTER TO SWITCH BETWEEN LEARNERS AND TRAINERS

                <ul v-for="item in $page.props.users.data" :key="item.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">{{item.name}}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                    <Link :href="route('users.edit', item.id)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit User</Link>
                                        <button @click.prevent="deleteUser(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Delete User
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div v-if="isAdmin($page.props.auth.user)" class="sm:flex">
                                    <p v-for="role in item.roles" :key="role.id" class="flex items-center text-sm text-gray-500 mr-1">
                                        <!-- Heroicon name: solid/users -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        {{ role.name }}
                                    </p>
                                    </div>
                                </div>
                                </div>

                            </li>
                    </ul>
                    <Pagination class="mt-6" :links="$page.props.users.links" />
            </template>
        </AdminDataDisplay>
    </AuthenticatedLayout>
</template>

