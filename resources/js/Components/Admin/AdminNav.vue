<script setup>
    import NavLink from '@/Components/NavLink.vue';

</script>
<template>
    <div class="hidden space-x-8 sm:-my-px sm:flex">
        <NavLink :href="route('currentcourses')" :active="route().current('currentcourses')">Current Courses</NavLink>
        <NavLink :href="route('courses')" :active="route().current('courses')">Courses</NavLink>
        <NavLink :href="route('cohorts')" :active="route().current('cohorts')">Cohorts</NavLink>
        <NavLink :href="route('funders')" :active="route().current('funders')">Funders</NavLink>
        <NavLink :href="route('sessions')" :active="route().current('sessions')">Sessions</NavLink>
    </div>

</template>
