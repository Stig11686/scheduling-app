<script setup>
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DashboardTileVue from '@/Components/DashboardTile.vue';
import NextSession from '@/Components/DashboardComponents/NextSession.vue';
import ComingSoon from '@/Components/DashboardComponents/ComingSoon.vue';

</script>

<template>
    <div>


            <AuthenticatedLayout>
                <template #header>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome {{$page.props.auth.user.name}}</h2>
                </template>

                <div class="py-12">
                    <div class="flex flex-wrap">
                        <div class="overflow-x-scroll h-100" v-if="$page.props.next_session">
                            <DashboardTileVue
                            title="Your Next Session"
                            type="Course"
                            linksTo="/schedule"
                            >
                                <NextSession
                                :data="$page.props.next_session"
                                />
                            </DashboardTileVue>
                        </div>

                        <div class="overflow-x-scroll h-100" v-if="$page.props.weeks_sessions">
                            <DashboardTileVue
                            title="This Weeks Sessions"
                            type="Course"
                            linksTo="/currentcourses"
                            >
                                <NextSession
                                :data="$page.props.weeks_sessions"
                                />
                            </DashboardTileVue>
                        </div>

                        <DashboardTileVue
                            title="Registers"
                        >
                            <ComingSoon />
                        </DashboardTileVue>
                        <DashboardTileVue
                            title="Outstanding Tasks"
                        >
                            <ComingSoon />
                        </DashboardTileVue>
                    </div>
                </div>
            </AuthenticatedLayout>
    </div>

</template>
