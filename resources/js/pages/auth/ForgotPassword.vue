<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import Toast from '@/components/Toast.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormInput, CFormLabel, CSpinner } from '@coreui/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthLayout title="Forgot password" description="Enter your email to receive a password reset link">
        <Head title="Forgot password" />

        <template #toast>
            <Toast v-if="status" class="fw-medium text-success">
                {{ status }}
            </Toast>
        </template>

        <form @submit.prevent="submit" class="d-flex flex-column gap-3">
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <CFormLabel for="email">Email address</CFormLabel>
                    <CFormInput
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="off"
                        v-model="form.email"
                        autofocus
                        placeholder="email@example.com"
                        :invalid="!!form.errors.email"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <CButton type="submit" color="primary" :disabled="form.processing">
                    <CSpinner v-if="form.processing" size="sm" />
                    Email password reset link
                </CButton>
            </div>

            <div class="text-center text-sm text-muted">
                Or, return to
                <Link :href="route('login')" class="link-body-emphasis">log in</Link>
            </div>
        </form>
    </AuthLayout>
</template>
