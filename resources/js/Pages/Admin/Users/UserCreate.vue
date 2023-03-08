<script setup>
    import AutheticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { useForm } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        user: Object,
        errors: Object
    })

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password2: '',
        roles: []
    })

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
                            <form @submit.prevent="submit" class="tr">

                                <div class="td">
                                    <input
                                        v-model="form.name"
                                        type="date"
                                        name="date"
                                        id="date"
                                        class="h-full w-full border-none bg-transparent pl-0"

                                    />
                                </div>
                                <div class="td">
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="h-full w-full border-none bg-transparent pl-0"

                                    />
                                </div>
                                <div class="td">
                                    <input
                                        v-model="form.password"
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="h-full w-full border-none bg-transparent pl-0"

                                    />
                                </div>
                                <div class="td">
                                    <input
                                        v-model="form.password2"
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="h-full w-full border-none bg-transparent pl-0"

                                    />
                                </div>

<!--
                                <div class="td">
                                    <select
                                        name="zoomRoomId"
                                        id="zoomRoomId"
                                        class="w-full h-full border-none bg-transparent pl-0"
                                        v-model=""
                                    >
                                        <option selected disabled value=""></option>
                                        <option value="">No Room</option>
                                            <option>

                                            </option>

                                    </select>
                                </div> -->

                                <div class="td">
                                    <button @click.prevent="submit" type="submit" v-if="can('instance_edit')" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </AutheticatedLayout>
</template>
