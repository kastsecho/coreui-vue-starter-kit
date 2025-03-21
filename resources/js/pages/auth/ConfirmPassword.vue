<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormInput, CFormLabel, CSpinner } from '@coreui/vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthLayout title="Confirm your password" description="This is a secure area of the application. Please confirm your password before continuing.">
        <Head title="Confirm password" />

        <form @submit.prevent="submit">
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <CFormLabel for="password">Password</CFormLabel>
                    <CFormInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                        :invalid="!!form.errors.password"
                    />

                    <InputError :message="form.errors.password" />
                </div>

                <CButton type="submit" color="primary" :disabled="form.processing">
                    <CSpinner v-if="form.processing" size="sm" />
                    Confirm Password
                </CButton>
            </div>
        </form>
    </AuthLayout>
</template>
