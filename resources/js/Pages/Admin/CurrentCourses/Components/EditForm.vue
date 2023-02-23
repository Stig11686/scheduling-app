<script setup>
    import formatDate from '@/helpers/formatDate';
    import { reactive } from 'vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';

    const state = reactive({ editMode: false });

    const toggleEdit = () => {
        state.editMode = !state.editMode;
    }

    const props = defineProps({
        'instanceId': {
            type: Number,
            default: null
        },
        'instanceSessionId': {
            type: Number,
            default: null
        },
        'sessionId': {
            type: Number,
            default: null
        },
        'date': {
            type: String,
            default: null,
        },
        'sessionName': {
            type: Object,
            default: null
        },
        'trainers': {
            type: Array,
            default: null
        },
        'trainer': {
            type: Object,
            default: null
        },
        'trainerId': {
            type: Number,
            default: ''
        },
        'zoomRooms' : {
            type: Array,
            default: null
        },
        'zoomRoom': {
            type: Object,
            default: null
        },
        'roomId': {
            type: Number,
            default: ''
        }
    })

    const form = useForm({
        instanceId: props.instanceId,
        sessionId: props.sessionId,
        date: props.date,
        sessionName: props.sessionName,
        zoomRoom: props.zoomRoom,
        roomId: props.roomId,
        trainer: props.trainer,
        trainerId: props.trainerId
    });

    const submit = () => {
        state.editMode = false;
        form.put(route('currentcourses.update', props.instanceId), {
            resetOnSuccess: false,
            preserveScroll: true
        });
    }

    const deleteSession = () => {
        form.delete(route('edit-session.destroy', props.instanceSessionId), {
            preserveScroll: true
        });
    }

</script>

<template>

        <form @submit.prevent="submit" class="tr">
            <input type="hidden" id="" name="instance_id" :value="instanceId" />
            <input type="hidden" id="session_id" name="session_id" :value="sessionId" />
            <div class="td">
                <input
                    :type="state.editMode ? 'date' : 'text'"
                    :disabled="state.editMode == false"
                    name="date"
                    id="date"
                    class="h-full w-full border-none pl-0"
                    :class="form.date ? 'bg-transparent' : 'bg-red-500 text-red-900'"
                    :value="form.date ? formatDate(form.date) : ''"
                />
            </div>

            <div class="td">
                <input
                    type="text"
                    id="session_name"
                    name="session_name"
                    disabled
                    :value="form.sessionName ? form.sessionName.name : '' " class="h-full border-none w-full bg-transparent pl-0"
                />
            </div>

            <div class="td">
                    <input
                    v-if="state.editMode == false"
                        name="trainer_id"
                        id="trainer_id"
                        disabled
                        class="h-full border-none w-full bg-transparent pl-0"
                        :value="form.trainer ? form.trainer.name : 'Press Edit to Add a Trainer'"
                    />

                    <select
                        v-else-if="state.editMode == true && form.trainer"
                        v-model="form.trainerId"
                        name="trainer_id"
                        id="trainer_id"
                        class="w-full h-full border-none bg-transparent pl-0"

                    >
                        <option selected disabled :value="form.trainer.name">{{ form.trainer.name }}</option>
                            <option v-for="trainer in trainers" :key="trainer.id" :value="trainer.id">
                            {{ trainer.user.name }}
                            </option>

                    </select>

                    <select
                        v-else
                        v-model="form.trainer.name"
                        name="trainer_id"
                        id="trainer_id"
                        class="w-full h-full border-none bg-transparent pl-0"

                    >
                        <option selected disabled value="null">Select Value</option>
                            <option v-for="trainer in trainers" :key="trainer.id" :value="trainer.id">
                            {{ trainer.user.name }}
                            </option>

                    </select>
            </div>

            <div class="td">
                    <input
                    v-if="state.editMode == false"
                        name="zoom_id"
                        id="zoom_id"
                        disabled
                        class="h-full border-none w-full bg-transparent pl-0"
                        :value="form.zoomRoom ? form.zoomRoom.link : 'Press Edit to Add a Zoom Room'"
                    />

                    <select
                        v-else-if="state.editMode == true && form.zoomRoom"
                        v-model="form.roomId"
                        name="zoom_id"
                        id="zoom_id"
                        class="w-full h-full border-none bg-transparent pl-0"

                    >
                        <option selected disabled :value="form.zoomId">{{ form.zoomRoom }}</option>
                            <option v-for="room in zoomRooms" :key="room.id" :value="room.id">
                            {{ room.name }}
                            </option>

                    </select>

                    <select
                        v-else
                        v-model="form.roomId"
                        name="zoom_id"
                        id="zoom_id"
                        class="w-full h-full border-none bg-transparent pl-0"

                    >
                        <option selected disabled value="null">Select Room</option>
                            <option v-for="room in zoomRooms" :key="room.id" :value="room.id">
                            {{ room.name }}
                            </option>

                    </select>
            </div>

            <div class="td">
                <Link :href="(route('edit-session.edit', instanceSessionId))" v-if="can('instance_edit')" :class="{ hidden: state.editMode}" class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Edit</Link>
                <button class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800" @click.prevent="deleteSession">Delete</button>
            </div>
        </form>

</template>

