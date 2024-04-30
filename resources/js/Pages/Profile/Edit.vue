<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    user: {
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
</script>
<template>
    <Head :title="heading" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{heading}}</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :user="props.user"
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
