<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type:Object,
        required: true
    }
}); 

const viewUser = (userId) => {
    router.get(route('profile.edit', { user: userId}));
};
</script>
<template>
<table class="w-full table-auto">
    <thead>
        <tr>
            <th>Staff name</th>
            <th>Department</th>
            <th>Staff status</th>
        </tr>
        </thead>
        <tbody>
            <tr  v-for="user in props.users" :key="user">
                <td @click="viewUser(user.id)" class="font-bold hover:underline hover:cursor-pointer">{{ user.name }}</td>
                <td>{{ user.department.name }}</td>
                <td>{{user.status}}</td>
            </tr>
        </tbody>
    </table>
</template>
