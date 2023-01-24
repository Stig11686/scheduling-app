<script setup>
 const props = defineProps({
    'data': {
        'type': Array,
        'default': []
    }
 })
</script>
<template>
    <div class="max-w-7xl mx-auto">
        <slot name="data"> </slot>
   </div>
</template>
