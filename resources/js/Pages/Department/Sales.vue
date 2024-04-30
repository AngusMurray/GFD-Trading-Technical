<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DashboardTile from '@/Components/DashboardTile.vue';
import { ref } from 'vue';

const props = defineProps({
    department: {
        type: Object,
        required: false
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Sales dashboard</h2>
        </template>
 
        <div class="py-12">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Welcome to your department dashboard!</div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
