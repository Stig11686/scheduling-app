<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import Accordion from '@/Components/Accordion.vue';
    import formatDate from '@/helpers/formatDate.js';
    import { Link } from '@inertiajs/inertia-vue3';
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
                    <ul v-for="item in $page.props.instances" :key="item.id" role="list" class="divide-y space-y-4 divide-gray-200">
                            <li class="my-">
                                <Accordion :title="item.course.name" :cohort="item.cohort.name">
                                    <template #content>
                                        <table class="w-full">
                                            <tr>
                                                <th>Date</th>
                                                <th>Session Title</th>
                                                <th>Trainer</th>
                                                <th>Zoom Link</th>
                                            </tr>
                                            <tr v-for="session in item.instance_sessions" :key="session.id">
                                                <td><p v-if="session.date">{{formatDate(session.date)}}</p></td>
                                                <td><p v-if="session.session">{{ session.session.name }}</p></td>
                                                <td><p v-if="session.trainer">{{ session.trainer.name }}</p></td>
                                                <td><p v-if="session.zoom_room"><Link :href="session.zoom_room.link">{{ session.zoom_room.link}}</Link></p> </td>
                                            </tr>
                                        </table>

                                    </template>
                                </Accordion>
                            </li>
                    </ul>
                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
