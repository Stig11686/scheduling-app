<script setup>
    import NavLink from '@/Components/NavLink.vue';
    import Dropdown from '../Dropdown.vue';
    import DropdownLink from '../DropdownLink.vue';

</script>
<template>
    <div class="flex items-center justify-content-center">
        <div class="ml-3 relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                            Admin Menu

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink :href="route('currentcourses')"> Current Courses </DropdownLink>
                    <DropdownLink :href="route('courses')">Courses</DropdownLink>
                    <DropdownLink :href="route('cohorts')">Cohorts</DropdownLink>
                    <DropdownLink :href="route('funders')">Funders</DropdownLink>
                    <DropdownLink :href="route('sessions')">Sessions</DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>

</template>
