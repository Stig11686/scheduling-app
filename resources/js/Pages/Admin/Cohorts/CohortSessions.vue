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
                :title="`${$page.props.cohort.name} Sessions`">
            </AdminPageHeader>
        </template>
        <template #default>
            <AdminDataDisplay>
                <template #data>
                        <ul v-for="item in $page.props.sessions" :key="item.id" role="list" class="divide-y divide-gray-200">
                            <li>
                                {{ item.name }}
                            </li>
                        </ul>
                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
