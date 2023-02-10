<script setup>
import formatDate from '@/helpers/formatDate.js';
const props = defineProps({
    data: {
        type: Array,
        default : []
    }
})
</script>
<template #default>
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-x-scroll shadow-sm ring-1 ring-black ring-opacity-5">
            <table class="min-w-full divide-y divide-gray-300 overflow-x-scroll">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Date</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Session</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Trainer</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Course/Cohort</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Zoom Link</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="item in data" :key="item.id">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{formatDate( item.date )}}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.sessionTitle }}<br>
                        <a :href="item.sessionSlides" target="_blank">Slides</a> &nbsp;-- &nbsp;
                        <a :href="item.sessionNotes" target="_blank">Notes</a> <br>
                    </td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ item.trainer }}</td>
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
</template>
