<script setup lang="ts">
import Toast from '@/components/Toast.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CSpinner } from '@coreui/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};
</script>

<template>
    <AuthLayout title="Verify email" description="Please verify your email address by clicking on the link we just emailed to you.">
        <Head title="Email verification" />

        <template #toast>
            <Toast v-if="status === 'verification-link-sent'" class="fw-medium text-success">
                A new verification link has been sent to the email address you provided during registration.
            </Toast>
        </template>

        <form @submit.prevent="submit" class="d-flex flex-column gap-3">
            <CButton type="submit" color="primary" :disabled="form.processing">
                <CSpinner v-if="form.processing" size="sm" />
                Resend verification email
            </CButton>

            <Link :href="route('logout')" method="post" as="button" class="btn btn-link link-body-emphasis">Log out</Link>
        </form>
    </AuthLayout>
</template>
