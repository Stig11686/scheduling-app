<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import { formatDate, isValidDate } from '../helpers/formatDate'
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
        type: Array,
        default: []
    }
})

const objKeys = computed(() => {
    if(!props.data[0]) return;

    const keys = Object.keys(props.data[0]).map(key => formatKey(key));

    return keys;

})

const formatKey = key => {
   // Split the string at each capital letter
  const regex = /(?=[A-Z])/;
  const words = key.split(regex);

  // Capitalize the first letter of each word
  const capitalizedWords = words.map(word => {
    return word.charAt(0).toUpperCase() + word.slice(1);
  });

  // Join the capitalized words with spaces to create a sentence
  const sentence = capitalizedWords.join(" ");

  // Return the sentence
  return sentence;
}

function isLink(str) {
  // Regular expression to match a link
  const regex = /^(ftp|http|https):\/\/[^ "]+$/;

  // Test if the string matches the regular expression
  return regex.test(str);
}


</script>

<template class="overflow-hidden h-100">
    <div class="px-4 sm:px-6 lg:px-8 mt-6 md:mt-0 bg-white mx-auto pt-6 my-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h2 class="text-xl font-semibold text-gray-900">{{title}}</h2>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <Link :href="linksTo" method="get" as="button" type="button">
                <!-- <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">View All</button> -->
                View All
            </Link>
        </div>
      </div>
      <div class="mt-8 flex flex-col overflow-x-auto">
        <table class="divide-y divide-gray-300 table-fixed">
                <thead class="bg-gray-50">
                <tr>
                    <th v-for="key in objKeys" :key="key" scope="col" class="w-1/3 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">{{key}}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="item in data" :key="item.id">
                    <td v-for="value in item" :key="value" class="w-1/3 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"><a v-if="isLink(value)" :href="value" _target="blank">{{value}}</a><span v-else-if="isValidDate(value)">{{ formatDate(value) }}</span><span v-else>{{ value }}</span></td>
                </tr>
                </tbody>
            </table>
      </div>
    </div>
  </template>

