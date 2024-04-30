<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue'
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    departments: {
        type: Object,
        required: true
    },
    is: {
        type: Array,
        required: true
    },
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const heading = props.is.self ? 'Profile' : props.user.name + '\'s profile'

const status = ref(false);

const setStatus = () => {
    status.value = !status.value;
    changeUserStatus();
};
const changeUserStatus = () => {
    router.patch(route('profile.status', {user: props.user.id}), {
        status: status.value
    }, {
        preserveScroll: true,
    });
};

</script>
<template>
    <Head :title="heading" />

    <AuthenticatedLayout>
        <template #header >
            <div class="flex gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{heading}}</h2>
                <DangerButton class="ms-3" @click="setStatus()">
                    <p v-if="props.user.status === 'active'">Deactivate user</p>
                    <p v-else>Activate user</p>
                </DangerButton>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :user="props.user"
                        :departments="props.departments"
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdatePasswordForm :user="props.user" class="max-w-xl" />
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <DeleteUserForm :user="props.user" class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
