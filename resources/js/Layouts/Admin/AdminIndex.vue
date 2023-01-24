<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <slot name="adminHeader"></slot>
        </template>
    <template>
        <slot name="default"></slot>
    </template>
    </AuthenticatedLayout>
</template>
