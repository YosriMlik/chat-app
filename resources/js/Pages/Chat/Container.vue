<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chatRoomSelection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    @roomchanged="setRoom($event)"
                />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <messageContainer :sendedmessages="messages" :key="messages" />
                    <inputMessage :room="currentRoom" :key="currentRoom" @messagesent="getMessages()" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onBeforeMount, watch } from "vue";
import axios from 'axios';

import AppLayout from '@/Layouts/AppLayout.vue';
import messageContainer from './messageContainer.vue';
import inputMessage from './inputMessage.vue';
import chatRoomSelection from './chatRoomSelection.vue';

let chatRooms = ref([]);
let currentRoom = ref({});
let messages = ref([]);

const getRooms = async () => {
    axios.get("/chat/rooms")
    .then(response => {
        chatRooms.value = response.data;
        setRoom(response.data[0]);
    })
    .catch(error => {
        console.log(error);
    })
}

const setRoom = async (room) => {
    currentRoom.value = room;
    getMessages();
}

const getMessages = async () => {
    //console.log('getting messages axios.get("/chat/room/"'+currentRoom.value.id+'"/messages")');
    await axios.get("/chat/room/"+currentRoom.value.id+"/messages")
    .then(response => {
        messages.value = response.data;
        //console.log('just got the messages (container.vue) : ', messages);
    })
    .catch(error => {
        console.log(error);
    })
}

function connect(){
    if(currentRoom.value.id){
        //console.log("connecting");
        getMessages();
        window.Echo.private("chat."+currentRoom.value.id)
        .listen(".chat.message", (e) => {
            //console.log("Listening on chat."+currentRoom.value.id);
            getMessages();
        })
    }
}

function disconnect(room){
    window.Echo.leave("chat."+room.id)
}

watch(currentRoom, (newcurrentRoom) => {
    //console.log("vue watch: Room changed to ", currentRoom.value.name);
    if(currentRoom.id){
        disconnect(currentRoom);
    }
    connect();
})

onBeforeMount(() => {
    //console.log("container.vue mounted, messages : ", messages);
    getRooms();
    connect();
});
</script>
