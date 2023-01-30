<template>
    <div>
        <div @click="toggleAccordion" id="accordionTitle" class="w-full bg-white font-bold my-4 cursor-pointer py-3 pl-2">{{ title }} || {{  cohort  }}</div>
        <div id="accordionContent" :class="state.isOpen ? 'block' : 'hidden'" class="pl-2 overflow-x-auto">
            <slot name="content"></slot>
        </div>
    </div>
</template>
<script setup>
import { reactive } from 'vue'
    const props = defineProps({
        'title': String,
        'cohort': String
    })

    const state = reactive({isOpen: false});

    const toggleAccordion = () => state.isOpen = !state.isOpen;

</script>
<style lang="">

</style>
