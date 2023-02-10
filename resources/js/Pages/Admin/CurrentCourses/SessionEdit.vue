<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import formatDate from '@/helpers/formatDate';

const props = defineProps({
    session: Object,
    default: () => ({
    })
})

const form = useForm({
    date: props.session[0].date,
    sessionId: props.session[0].session.id,
    trainerId: props.session[0].trainer_id,
    zoomRoomId: props.session[0].zoom_room.id,
    trainer: props.session[0].trainer
})

const submit = () => {
    form.put(route('edit-session.update', props.session[0].id));

}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit {{ $page.props.session[0].session.name }} - {{ $page.props.session[0].cohort.name }}</h2>
        </template>
        <template #default>
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
                            <form @submit.prevent="submit" class="tr">

                                <div class="td">
                                    <input
                                        v-model="form.date"
                                        type="date"
                                        name="date"
                                        id="date"
                                        class="h-full w-full border-none bg-transparent pl-0"

                                    />
                                </div>

                                <div class="td">

                                    <select
                                        name="session_id"
                                        id="session_id"
                                        class="w-full h-full border-none bg-transparent pl-0"
                                        v-model="form.sessionId"
                                    >
                                        <option selected disabled value="">{{ props.session[0].session.name }}</option>
                                            <option v-for="session in $page.props.sessions" :key="session.id" :value="session.id">
                                            {{ session.name }}
                                            </option>

                                    </select>
                                </div>

                                <div class="td">

                                        <select
                                            name="trainerId"
                                            id="trainerId"
                                            class="w-full h-full border-none bg-transparent pl-0"
                                            v-model="form.trainerId"
                                        >
                                            <option selected disabled value="">{{ props.session[0].trainer.name }}</option>
                                                <option v-for="trainer in $page.props.trainers" :key="trainer.id" :value="trainer.id">
                                                {{ trainer.user.name }}
                                                </option>

                                        </select>
                                </div>

                                <div class="td">
                                    <select
                                        name="zoomRoomId"
                                        id="zoomRoomId"
                                        class="w-full h-full border-none bg-transparent pl-0"
                                        v-model="form.zoomRoomId"
                                    >
                                        <option selected disabled value="">{{ props.session[0].zoom_room.name }}</option>
                                            <option v-for="room in $page.props.zoom_rooms" :key="room.id" :value="room.id">
                                                {{ room.name }}
                                            </option>

                                    </select>
                                </div>

                                <div class="td">
                                    <button @click.prevent="submit" type="submit" v-if="can('instance_edit')" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
