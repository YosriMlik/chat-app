<template>
    <div>
        <div class="h-96 w-full">
            <div v-if="themessages.length > 0" class="h-full p-2 flex flex-col-reverse overflow-scroll">
                <div v-for="message in themessages" :key="message.id">
                    <messageItem :themessage="message" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, onBeforeMount } from "vue";
import messageItem from './messageItem.vue';

const props = defineProps(['sendedmessages']);
let themessages = ref([]);

onBeforeMount(() => {
    themessages.value = props.sendedmessages;
})
</script>

<style>

</style>
