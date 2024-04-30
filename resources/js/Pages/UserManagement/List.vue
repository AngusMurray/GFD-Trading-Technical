<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UserListTable from '@/Components/UserListTable.vue';

const props = defineProps({
    users: {
        type: Object,
        required: false
    },
});

</script>
<template>
    <Head title="User management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">User management</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p v-for="user in props.users" :key="user">{{ user.name }}</p>
                    </div>
                    <UserListTable :users="props.users" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
