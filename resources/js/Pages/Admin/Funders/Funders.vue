<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';

    const form = useForm();

    const deleteFunder = item => {
        form.delete(route('funders.destroy', item))
    }
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="Funders"
                href="funders.create"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <ul v-for="item in $page.props.funders" :key="item.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">{{item.name}}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                    <Link :href="route('funders.edit', item.id)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Edit Funder</Link>
                                    <button @click.prevent="deleteFunder(item)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Delete Funder</button>
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

