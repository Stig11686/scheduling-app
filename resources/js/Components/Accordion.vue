<template>
    <div>
        <div @click="toggleAccordion" id="accordionTitle" class="flex justify-between w-full bg-white font-bold my-4 cursor-pointer py-3 pl-2">
            <div>
                {{ title }} || {{  cohort  }}
            </div>
            <div @click="state.isOpen = false" class="mr-2">
                <Link :href="route('currentcourses.edit', instanceId)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 z-10">Add Sessions</Link>
            </div>
        </div>
        <div id="accordionContent" :class="state.isOpen ? 'block' : 'hidden'" class="pl-2 overflow-x-auto">
            <slot name="content"></slot>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
    const props = defineProps({
        'title': String,
        'cohort': String,
        'instanceId': Number
    })

    const state = reactive({isOpen: false});

    const toggleAccordion = () => state.isOpen = !state.isOpen;

</script>
