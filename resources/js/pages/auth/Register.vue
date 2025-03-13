<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormInput, CFormLabel, CSpinner } from '@coreui/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthLayout title="Create an account" description="Enter your details below to create your account">
        <Head title="Register" />

        <form @submit.prevent="submit" class="d-flex flex-column gap-3">
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <CFormLabel for="name">Name</CFormLabel>
                    <CFormInput
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        v-model="form.name"
                        placeholder="Full name"
                        :invalid="!!form.errors.name"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="d-grid">
                    <CFormLabel for="email">Email address</CFormLabel>
                    <CFormInput
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                        :invalid="!!form.errors.email"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="d-grid">
                    <CFormLabel for="password">Password</CFormLabel>
                    <CFormInput
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Password"
                        :invalid="!!form.errors.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="d-grid">
                    <CFormLabel for="password_confirmation">Confirm password</CFormLabel>
                    <CFormInput
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                        :invalid="!!form.errors.password_confirmation"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <CButton type="submit" color="primary" tabindex="5" :disabled="form.processing">
                    <CSpinner v-if="form.processing" size="sm" />
                    Create account
                </CButton>
            </div>

            <div class="text-center text-muted">
                Already have an account?
                <Link :href="route('login')" class="link-body-emphasis" :tabindex="6">Log in</Link>
            </div>
        </form>
    </AuthLayout>
</template>
