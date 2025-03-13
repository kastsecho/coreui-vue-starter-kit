<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormInput, CFormLabel, CSpinner } from '@coreui/vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    token: string;
    email: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthLayout title="Reset password" description="Please enter your new password below">
        <Head title="Reset password" />

        <form @submit.prevent="submit">
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <CFormLabel for="email">Email</CFormLabel>
                    <CFormInput
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="email"
                        v-model="form.email"
                        disabled
                        :invalid="!!form.errors.email"
                    />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="d-grid">
                    <CFormLabel for="password">Password</CFormLabel>
                    <CFormInput
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        v-model="form.password"
                        autofocus
                        placeholder="Password"
                        :invalid="!!form.errors.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="d-grid">
                    <CFormLabel for="password_confirmation"> Confirm Password </CFormLabel>
                    <CFormInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                        :invalid="!!form.errors.password_confirmation"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <CButton type="submit" color="primary" :disabled="form.processing">
                    <CSpinner v-if="form.processing" size="sm" />
                    Reset password
                </CButton>
            </div>
        </form>
    </AuthLayout>
</template>
