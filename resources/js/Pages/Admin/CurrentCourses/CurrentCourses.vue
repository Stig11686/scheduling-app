<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import Accordion from '@/Components/Accordion.vue';
    import formatDate from '@/helpers/formatDate.js';
    import { Link } from '@inertiajs/inertia-vue3';
    import Pagination from '@/Components/Pagination.vue';
    import EditForm from '@/Pages/Admin/CurrentCourses/Components/EditForm.vue';

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="Courses"
                href="currentcourses.create"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <ul>
                            <li v-for="item in $page.props.instances.data" :key="item.id" role="list" class="divide-y space-y-4 divide-gray-200 overflow-x-auto">
                                <Accordion :instanceId="item.id" :title="item.course.name" :cohort="item.cohort.name">
                                    <template #content>
                                        <div class="table overflow-x-scroll">
                                            <div class="thead">
                                                <div class="tr">
                                                    <div class="td">Date</div>
                                                    <div class="td">Session Title</div>
                                                    <div class="td">Trainer</div>
                                                    <div class="td">Zoom Link</div>
                                                </div>
                                            </div>
                                            <div class="tbody">
                                                <EditForm v-for="session in item.instance_sessions" :key="session.id"
                                                    :instanceId=session.instance_id
                                                    :instanceSessionId="session.id"
                                                    :sessionId=session.session_id
                                                    :date="session.date"
                                                    :sessionName="session.session.name"
                                                    :trainers="$page.props.trainers"
                                                    :trainer="session.trainer"
                                                    :trainerId="session.trainer_id"
                                                    :zoomRooms="$page.props.zoom_rooms"
                                                    :zoomRoom="session.zoom_room.link"
                                                    :roomId="session.zoom_room_id"
                                                />
                                            </div>
                                        </div>

                                    </template>
                                </Accordion>
                            </li>
                    </ul>

                    <Pagination class="mt-6" :links="$page.props.instances.links" />
                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>

