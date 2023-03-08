<script setup>
    import AutheticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { useForm } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        user: Object,
        errors: Object
    })

    const roles = props.user[0].roles.map(x => x.id);

    const form = useForm({
        name: props.user[0].name,
        email: props.user[0].email,
        password: '',
        password2: '',
        roles: roles
    })

    const submit = () => {
        form.put(route('users.update', props.user[0].id))
    }

</script>
<template>
    <AutheticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage {{props.user[0].name}} </h2>
        </template>
        <template #default>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div v-if="Object.keys(props.errors).length > 0" class="bg-red-500 text-white py-4 px-2 mb-6">
                                <p>{{ props.errors.dateUnique }}</p>
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
                                    <div class="sm:col-span-4">
                                        <button @click.prevent="submit" type="submit" v-if="can('instance_edit')" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Submit</button>
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
