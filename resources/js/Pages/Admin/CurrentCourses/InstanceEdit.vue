<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({

});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome {{$page.props.auth.user.name}}</h2>
        </template>

        <template #default>
            <ul>
                <li v-for="session in $page.props.sessions" :key="session.id">
                    <label>{{ session.name  }}</label><input :id="session.id" :name="session.id" type="checkbox" :value="session.id" />
                </li>
            </ul>
        </template>

    </AuthenticatedLayout>
</template>
