<template>
    <div>
        <div class="relative m-1">
            <div style="" class="grid grid-cols-6">
                <input type="text" name="message" id="message"
                class="col-span-5 outline-none p-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 resize-y"
                rows="1"
                v-model="message" @keyup.enter="sendMessage()" placeholder="Say Something ..">
                <button @click="sendMessage" class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                    Send
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, defineProps, defineEmits } from "vue";
import axios from 'axios';

const props = defineProps(['room']);
const room = ref({});
const message = ref("");
const emit = defineEmits(['messagesent']);

const sendMessage = async () => {
    if (message.value === "") {
        return;
    }
    //console.log(`/chat/room/${room.value.id}/message`);
    await axios.post(`/chat/room/${room.value.id}/message`, {
        message: message.value
    })
    .then(response => {
        if (response.status === 201) {
            message.value = "";
            emit('messagesent'); // Emitting the 'messagesent' event to the parent component
        }
    })
    .catch(error => {
        console.log(error);
    });
}

onBeforeMount( async () => {
    room.value = props.room;
    /*if (props.room.id != null) {
        room.value = props.room;
        //console.log("Room is passed:", room.value);
    } else {
        await axios.get("/chat/rooms")
        .then(response => {
            room.value = response.data[0];
            //console.log("After getting room, it will be:", room.value);
            //console.log("Room ID:", room.value.id);
        })
        .catch(error => {
            console.log(error);
        });
    }*/
});
</script>

<style>
/* Your scoped styles go here */
</style>
