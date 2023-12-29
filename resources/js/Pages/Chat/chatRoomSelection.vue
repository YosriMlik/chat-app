<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{ selected.name }} Chat
        </div>
        <div>
            <select v-model="selected"
            @change="emit('roomchanged', selected)"
            class="float-right">
                <option v-for="room in rooms" :key="room.id" :value="room">
                    {{ room.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, onBeforeMount, watch } from "vue";

const props = defineProps(['rooms', 'currentRoom']);
const rooms = ref([]);
const selected = ref("");
const emit = defineEmits(['roomchanged'])


/*function connect(){
    if(selected.value.id){
        let vm = this;
        emit('onChanging');
        console.log("Listening on chat."+selected.value.id);
        window.Echo.private("chat."+selected.value.id)
        .listen(".message.new", e => {
            emit('onChanging');
        })
    }
}

function disconnect(room){
    window.Echo.leave("chat."+room.id)
}

watch(selected, (newselected) => {
    console.log("Room changed to ", selected.value.name);
    if(selected.value.id){
        disconnect(selected);
    }
    connect();
})*/

onBeforeMount(() => {
    rooms.value = props.rooms
    selected.value = props.currentRoom
})
</script>

<style lang="scss" scoped>

</style>
