<script setup>
    import AutheticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';

    const props = defineProps({
        user: Object,
        errors: Object,
        cohorts: {
            type: Array,
            default: []
        }
    })

    const roles = props.user.roles.map(x => x.id);

    const form = useForm({
        id: props.user.id,
        name: props.user.name,
        email: props.user.email,
        roles: roles,
        cohort_id: props.user.cohort_id
    });

    const isTrainerSelected = computed(() => {
        return form.roles.includes(3); // assuming the trainer role has an id of 3
    });

    const isLearnerSelected = computed(() => {
        return form.roles.includes(4); // assuming the trainer role has an id of 3
    });


    const submit = () => {
        form.put(route('users.update', props.user.id))
    };

    const changes = 'changes';

</script>
<template>
    <AutheticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage {{props.user.name}} </h2>
        </template>
        <template #default>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div v-if="$page.props.flash.success" class="bg-green-500 text-white py-4 px-2 rounded-md mb-6">
                                {{ $page.props.flash.success }}
                            </div>

                            <div v-if="Object.keys(props.errors).length > 0" class="bg-red-500 text-white py-4 px-2 mb-6">
                                <p v-for="error in props.errors" :key="error
                                ">{{ error }}</p>
                            </div>
                            <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> User Name </label>
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                       />
                                    </div>
                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700"> User Email </label>
                                        <input
                                            v-model="form.email"
                                            type="text"
                                            name="email"
                                            id="email"
                                            class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                       />
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="roles[]" class="block text-sm font-medium text-gray-700"> User Roles </label>
                                        <div v-for="role in $page.props.allRoles" :key="role.id" class="col-span-2">
                                            <input
                                                type="checkbox"
                                                name="roles[]"
                                                :value="role.id"
                                                :id="role.id"
                                                v-model="form.roles"
                                            />
                                            <label class="ml-2" :for="role.id">
                                                {{ role.name }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-6" v-if="isTrainerSelected">
                                        <p>Trainer is selected!</p>
                                        <fieldset class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                            <div class="sm:col-span-4">
                                                <label for="has_dbs" class="block text-sm font-medium text-gray-700"> Has DBS? </label>
                                                <input
                                                    v-model="form.has_dbs"
                                                    type="checkbox"
                                                    name="has_dbs"
                                                    id="has_dbs"
                                                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block min-w-0 rounded-none rounded-md sm:text-sm border-gray-300"
                                                />
                                            </div>
                                            <div class="sm:col-span-4">
                                                <label for="dbs_expiry" class="block text-sm font-medium text-gray-700"> DBS Expiry date </label>
                                                <input
                                                    v-model="form.dbs_expiry"
                                                    type="date"
                                                    name="dbs_expiry"
                                                    id="dbs_expiry"
                                                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                />
                                            </div>
                                            <div class="sm:col-span-4">
                                                <label for="dbs_upload" class="block text-sm font-medium text-gray-700"> DBS Upload  </label>
                                                <input
                                                    type="file"
                                                    name="dbs_upload"
                                                    id="dbs_upload"
                                                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                />
                                            </div>
                                            <div class="sm:col-span-4">
                                                <label for="name" class="block text-sm font-medium text-gray-700"> Has Completed Mandatory Training </label>
                                                <input
                                                    v-model="form.mandatory_training"
                                                    type="checkbox"
                                                    name="mandatory_training"
                                                    id="mandatory_training"
                                                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block min-w-0 rounded-none rounded-md sm:text-sm border-gray-300"
                                                />
                                            </div>
                                            <div class="sm:col-span-4">
                                                <label for="dbs_upload" class="block text-sm font-medium text-gray-700"> Mandatory Training Certs </label>
                                                <input
                                                    type="file"
                                                    name="training_certs[]"
                                                    id="training_certs"
                                                    class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                    multiple
                                                />
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="sm:col-span-6" v-if="isLearnerSelected">
                                        <p>Learner is selected!</p>
                                        <fieldset class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                            <div class="sm:col-span-4">
                                                <label for="dbs_upload" class="block text-sm font-medium text-gray-700"> Cohort</label>
                                                <select>
                                                    <option v-for="cohort in props.cohorts" :key="cohort.id">{{ cohort.name }}</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="sm:col-span-4">
                                        <button @click.prevent="submit" type="submit" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </AutheticatedLayout>
</template>
