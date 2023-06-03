<script setup>
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DashboardTileVue from '@/Components/DashboardTile.vue';


</script>

<template>
    <div>


            <AuthenticatedLayout>
                <template #header>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome {{$page.props.auth.user.name}}</h2>
                </template>

                <div class="py-12 flex flex-wrap">
                    <div v-if="$page.props.data">
                        <div v-for="item in $page.props.data" :key="item" class="h-100 max-w-7xl">
                            <DashboardTileVue
                            :title=item.title
                            :data=item.data
                            :linksTo="'/schedule/'"
                            >
                            </DashboardTileVue>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
    </div>

</template>
