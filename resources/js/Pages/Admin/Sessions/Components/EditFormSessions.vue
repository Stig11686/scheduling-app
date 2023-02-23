<script setup>
    import formatDate from '@/helpers/formatDate';
    import { reactive } from 'vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';

    const state = reactive({ editMode: false });

    const toggleEdit = () => {
        state.editMode = !state.editMode;
    }

    const props = defineProps({
        'sessionId': {
            type: Number,
            default: null
        },
        'name': {
            type: String,
            default: null
        },
        'reviewStatus': {
            type: String,
            default: null
        },
        'reviewDue': {
            type: String,
            default: null
        },
        'slides': {
            type: String,
            default: null,
        },
        'notes': {
            type: String,
            default: ''
        }
    })

    const form = useForm({
        name: props.name,
        review_due: props.reviewDue,
        review_status: props.reviewStatus,
        slides: props.slides,
        trainer_notes: props.notes,
    });

    const submit = (session) => {
        state.editMode = false;
        form.put(route('sessions.update', session), {
            resetOnSuccess: false,
            preserveScroll: true
        });
    }

    const deleteSession = (session) => {
        form.delete(route('sessions.destroy', session), {
            preserveScroll: true
        });
    }
</script>

<template>

        <form @submit.prevent="submit" class="tr">
            <input type="hidden" id="session_id" name="session_id" :value="sessionId" />
            <div class="td">
                <input
                    type="text"
                    :disabled="state.editMode == false"
                    name="name"
                    id="name"
                    class="h-full w-full border-none pl-0"
                    :class="form.name ? 'bg-transparent' : 'bg-red-500 text-red-900'"
                    v-model="form.name"
                />
            </div>

            <div class="td">
                <input
                    type="text"
                    id="review_due"
                    name="review_due"
                    :disabled="state.editMode == false"
                    v-model="form.review_status"
                    class="h-full border-none w-full bg-transparent pl-0"
                />
            </div>

            <div class="td">
                <input
                    name="review_due"
                    type="date"
                    id="review_due"
                    :disabled="state.editMode == false"
                    class="h-full border-none w-full bg-transparent pl-0"
                    v-model="form.review_due"
                />
            </div>

            <div class="td">
                <input
                    name="slides"
                    id="slides"
                    :disabled="state.editMode == false"
                    class="h-full border-none w-full bg-transparent pl-0"
                    v-model="form.slides"
                />
            </div>

            <div class="td">
                <input
                    name="notes"
                    id="notes"
                    :disabled="state.editMode == false"
                    class="h-full border-none w-full bg-transparent pl-0"
                    v-model="form.trainer_notes"
                />
            </div>

            <div class="td">
                <!-- <Link :href="(route('edit-session.edit', instanceSessionId))" v-if="can('instance_edit')" :class="{ hidden: state.editMode}" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Edit</Link> -->
                <button class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800" @click.prevent="deleteSession(sessionId)">Delete</button>
            </div>
        </form>

</template>

