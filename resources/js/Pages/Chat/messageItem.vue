<script setup>
import { document } from "postcss";
import { ref, onBeforeMount, defineProps, watch, reactive } from "vue";

const props = defineProps(['themessage']);
const themessage = ref({});

onBeforeMount(async () => {
    themessage.value = props.themessage;
})

</script>

<template>
    <!--div class="flex flex-row">

    </div>
    <div class="flex flex-row my-2 mt-0 pt-0 mb-7">

    </div-->

    <div class="grid-container">

        <div class="grid-item"></div>

        <div class="grid-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock"
                style="margin-top: .5px; margin-right: 4px; display: inline;"
                viewBox="0 0 16 16">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
            </svg>
            <small style="font-size: 10px;">{{ themessage.created_at.substring(0, 10) }} {{ themessage.created_at.substring(11, 16) }}</small>
        </div>

        <div class="grid-item" id="username" :style="{width: (themessage.user.name.length*10)+'px'}">
            <!--svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle"
                style="margin-bottom: 3.5px; margin-right: 4px; display: inline;" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg-->
            <div class="me-2" style="display: inline;"><b>{{ themessage.user.name }}:</b></div>
        </div>

        <div class="grid-item">
            <div class="bg-slate-200 p-2 rounded-b-lg rounded-tr-lg w-full mt-1"> {{ themessage.message }}</div>
        </div>
    </div>
</template>

<style>
.grid-container {
  display: grid;
  grid-template-columns: min-content auto;
  padding: 10px;
}
.grid-item {
  text-align: left;
}
</style>
