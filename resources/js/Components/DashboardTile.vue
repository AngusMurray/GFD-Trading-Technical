<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    department: {
        type: Object,
        required: true
    },
    icon: {
        type: String,
        required: true
    },
    path: {
        type: String,
        required: false
    }
});          
</script>
<template>
    <div class="grid h-64 grid-cols-1 transition ease-in-out bg-white rounded-lg drop-shadow-lg hover:scale-105 hover:cursor-pointer">
        <div class="flex flex-col items-center content-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" :d="props.icon" />
            </svg>
            <h2>{{props.department.name}}</h2>
        </div>
    </div>
</template>
