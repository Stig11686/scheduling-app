<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import formatDate from '../helpers/formatDate.js'
const props = defineProps({
    title: {
        type: String,
        default: 'Users'
    },
    type: {
        type: String,
        default: ''
    },
    linksTo: {
        type: String
    },
    data: {
        type: Array
    }
})

</script>

<template class="overflow-x-scroll h-100">
    <div class="px-4 sm:px-6 lg:px-8 mt-6 md:mt-0 bg-white mx-auto pt-6 my-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">{{title}}</h1>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <Link :href="linksTo" method="get" as="button" type="button">
                <!-- <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">View All</button> -->
                View All
            </Link>
        </div>
      </div>
      <div class="mt-8 flex flex-col">
            <slot name="default"></slot>
      </div>
    </div>
  </template>

