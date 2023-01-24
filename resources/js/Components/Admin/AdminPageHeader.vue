<script setup>
    import { Link } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        'href': {
            'type': String,
            'default': null
        },
        'title': String
    });
</script>
<template>
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{title}}</h2>
        <div v-if="href" class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center">
        <Link :href="route(href)">
            <span class="text-white text-xl">+</span>
         </Link>
      </div>
   </div>

</template>
