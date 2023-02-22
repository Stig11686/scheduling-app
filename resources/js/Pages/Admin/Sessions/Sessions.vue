<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import Pagination from '@/Components/Pagination.vue';
    import EditFormSessions from './Components/EditFormSessions.vue';

    const form = useForm();

    const deleteSession = (item) => {
        form.delete(route('sessions.destroy', item))
    }

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="Sessions"
                href="sessions.create"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <div class="table overflow-x-scroll">
                        <div class="thead">
                            <div class="tr">
                                <div class="td">Name</div>
                                <div class="td">Review Status</div>
                                <div class="td">Review Due</div>
                                <div class="td">Slides Link</div>
                                <div class="td">Trainer Notes Link</div>
                            </div>
                        </div>
                        <div class="tbody">
                            <EditFormSessions v-for="item in $page.props.sessions.data" :key="item.id" role="list"
                                :sessionId="item.id"
                                :name="item.name"
                                :reviewStatus="item.review_status"
                                :reviewDue="item.review_due"
                                :slides="item.slides"
                                :notes="item.trainer_notes"
                            />
                        </div>
                        </div>
                    <Pagination :links="$page.props.sessions.links" />
                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
