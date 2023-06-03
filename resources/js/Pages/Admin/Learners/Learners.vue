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
                title="Learner Management"
                href=""
            />
        </template>
        <AdminDataDisplay>
            <template #data>
                //TODO - ADD FILTER TO SWITCH BETWEEN LEARNERS AND TRAINERS

                <ul v-for="item in $page.props.learners.data" :key="item.user.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">{{  item.user.name  }} {{ item.cohort.name  }} {{ item.cohort.course.name }}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                    <!-- <Link href="" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit User</Link>
                                        <button @click.prevent="deleteUser(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Delete User
                                        </button> -->
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">

                                </div>
                                </div>

                            </li>
                    </ul>
                    <Pagination class="mt-6" :links="$page.props.learners.links" />
            </template>
        </AdminDataDisplay>
    </AuthenticatedLayout>
</template>

