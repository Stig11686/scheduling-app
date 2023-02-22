<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import AdminPageHeader from '@/Components/Admin/AdminPageHeader.vue';
    import AdminDataDisplay from '@/Components/Admin/AdminDataDisplay.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    import Pagination from '@/Components/Pagination.vue';
    import formatDate from '@/helpers/formatDate';

    const props = defineProps({
        errors: Object
    })

    const showSessions = ref(false);

    const showCohortCreate = ref(false);

    const form = useForm({
        courseId: '',
        cohortId: '',
        sessions: [],
        newCohort: '',
        newCohortPlaces: ''
    });

    const cohortForm = useForm({
        name: '',
        places: 24,
        startDate: '',
        endDate: ''
    });

    const submitCourse = (item) => {
        form.post(route('currentcourses.store', item));
    }
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <AdminPageHeader
                title="Add a new Course Instance"
            />
        </template>

        <template #default>
            <AdminDataDisplay>
                <template #data>
                    <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- @if($errors->any())
                                <div class="bg-red-500 text-white py-4 px-2">
                                    @foreach($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif -->
                            <form @submit.prevent="submitCourse" class="space-y-8 divide-y divide-gray-200">
                                <div class="space-y-8 divide-y divide-gray-200">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add a new Course Instance</h3>
                                        <p class="mt-1 text-sm text-gray-500"></p>
                                    </div>

                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                        <div class="sm:col-span-4">
                                            <label for="course_id" class="block text-sm font-medium text-gray-700"> Course Name </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" v-model="form.courseId">
                                                    <option v-for="item in $page.props.courses" :key="item.id" :value="item.id" >{{ item.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-4">
                                            <label for="cohort_id" class="block text-sm font-medium text-gray-700"> Cohort Name </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" v-model="form.cohortId">
                                                    <option v-for="item in $page.props.cohorts" :key="item.id" :value="item.id" >{{ item.name }}</option>
                                                </select>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-700">Need a new cohort? Click <span @click.prevent="showCohortCreate = !showCohortCreate">here</span></p>
                                            </div>
                                            <div v-show="showCohortCreate" class="space-y-8 divide-y divide-gray-200">
                                                <div class="space-y-8 divide-y divide-gray-200">
                                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                        <div class="sm:col-span-4">
                                                            <label for="name" class="block text-sm font-medium text-gray-700"> Cohort Name </label>
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <input type="text" name="name" id="name" v-model="form.newCohort"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" />
                                                            </div>
                                                            <label for="places" class="block text-sm font-medium text-gray-700"> Places </label>
                                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                                <input type="text" name="places" id="places" v-model="form.newCohortPlaces"  class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-4">
                                            <label @click="showSessions = !showSessions" for="course_id" class="block text-sm font-medium text-gray-700"> Click to add Sessions </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <div v-show="showSessions" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                    <div v-for="session in $page.props.sessions" :key="session.id" class="col-span-2">
                                                        <input
                                                            type="checkbox"
                                                            name="session_id[]"
                                                            :value="session.id"
                                                            :id="session.id"
                                                            v-model="form.sessions"
                                                        />
                                                        <label class="ml-1" :for="session.id">
                                                            {{ session.name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 pt-5">
                                    <div class="flex justify-end">
                                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                    <button @click.prevent="submitCourse" type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                </template>
            </AdminDataDisplay>
        </template>
    </AuthenticatedLayout>
</template>
