<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import Toast from '@/components/Toast.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormCheck, CFormInput, CFormLabel, CSpinner } from '@coreui/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthLayout title="Log in to your account" description="Enter your email and password below to log in">
        <Head title="Log in" />

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
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                        :invalid="!!form.errors.email"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="d-grid">
                    <div class="mb-2 d-flex align-items-center justify-content-between">
                        <CFormLabel class="mb-0" for="password">Password</CFormLabel>
                        <Link v-if="canResetPassword" :href="route('password.request')" class="link-body-emphasis" :tabindex="5">
                            Forgot password?
                        </Link>
                    </div>
                    <CFormInput
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Password"
                        :invalid="!!form.errors.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="d-grid" :tabindex="3">
                    <CFormCheck id="remember" label="Remember me" v-model="form.remember" :tabindex="4" />
                </div>

                <CButton type="submit" color="primary" :tabindex="4" :disabled="form.processing">
                    <CSpinner v-if="form.processing" size="sm" />
                    Log in
                </CButton>
            </div>

            <div class="text-center text-sm text-muted">
                Don't have an account?
                <Link :href="route('register')" class="link-body-emphasis" :tabindex="5">Sign up</Link>
            </div>
        </form>
    </AuthLayout>
</template>
