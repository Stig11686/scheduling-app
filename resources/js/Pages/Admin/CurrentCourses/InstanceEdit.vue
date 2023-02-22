<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, unref, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    existing_sessions: Array,
                        default: () => ([]
                        ),
    instance: Object,
            default: () => ({
            }),
    sessions: Object,
            default: () => ({}),

})

const proxyOf = data => new Proxy(data, {})

const existing_sessions = ref(unref(computed(() => proxyOf(props.existing_sessions.map(item => item.session_id)))));
const instance = unref(computed(() => proxyOf(props.instance.map(item => item.id))));
const cohort = unref(computed(() => proxyOf(props.instance.map(item => item.cohort_id))));
const sessions = props.sessions

console.log(cohort);

const form = useForm({
    sessions: existing_sessions,
    cohort: cohort
})

const submit = () => {
    form.patch(route('currentcourses.update', instance));
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage {{$page.props.instance[0].course.name}} - {{ $page.props.instance[0].cohort.name }} Sessions</h2>
        </template>

        <template #default>
            <!-- <ul>
                <li v-for="session in $page.props.sessions" :key="session.id">
                    <label>{{ session.name  }}</label><input :id="session.id" :name="session.id" type="checkbox" :value="session.id" />
                </li>
            </ul> -->

            <div class="">
                <form class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <input type="hidden" name="cohort_id" id="cohort_id" :value="form.cohort" />
                    <div v-for="session in $page.props.sessions" :key="session.id" class="col-span-2">
                        <input
                            type="checkbox"
                            name="session_id[]"
                            :value="session.id"
                            :id="session.id"
                            v-model="existing_sessions"
                        />
                        <label :for="session.id">
                            {{ session.name }}
                        </label>
                    </div>
                    <button @click.prevent="submit" class="mt-6">Submit</button>
                </form>
            </div>
        </template>

    </AuthenticatedLayout>
</template>
