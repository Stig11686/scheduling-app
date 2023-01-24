<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import formatDate from '../helpers/formatDate.js'


</script>

<template>
    <div>
        <Head title="Your schedule" />
        <AuthenticatedLayoutVue>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{$page.props.auth.user.name}}'s Schedule</h2>
            </template>

            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Date</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Session</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Course/Cohort</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Zoom Link</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="item in $page.props.sessions" :key="item.id">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{formatDate( item.date )}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.sessionTitle }}<br>
                                <a :href="item.sessionSlides" target="_blank">Slides</a> &nbsp;-- &nbsp;
                                <a :href="item.sessionNotes" target="_blank">Notes</a> <br>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ item.courseName }} <br>
                                {{ item.cohortName }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><a :href="item.zoom">{{ item.zoom  }}</a></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>

        </AuthenticatedLayoutVue>
    </div>

</template>

