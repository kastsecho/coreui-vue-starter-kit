<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import { CButton, CFormInput, CFormLabel } from '@coreui/vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Password settings',
        href: '/settings/password',
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (errors: any) => {
            if (errors.password) {
                form.reset('password', 'password_confirmation');
                if (passwordInput.value instanceof HTMLInputElement) {
                    passwordInput.value.focus();
                }
            }

            if (errors.current_password) {
                form.reset('current_password');
                if (currentPasswordInput.value instanceof HTMLInputElement) {
                    currentPasswordInput.value.focus();
                }
            }
        },
    });
};
</script>

<template>
    <AppLayout :breadcrumbs>
        <Head title="Password settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall title="Update password" description="Ensure your account is using a long, random password to stay secure" />

                <form @submit.prevent="updatePassword" class="d-grid gap-3">
                    <div class="d-grid">
                        <CFormLabel for="current_password">Current password</CFormLabel>
                        <CFormInput
                            id="current_password"
                            ref="currentPasswordInput"
                            type="password"
                            required
                            autocomplete="current-password"
                            v-model="form.current_password"
                            placeholder="Current password"
                            :invalid="!!form.errors.current_password"
                        />
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="d-grid">
                        <CFormLabel for="password">New password</CFormLabel>
                        <CFormInput
                            id="password"
                            ref="passwordInput"
                            type="password"
                            required
                            autocomplete="new-password"
                            v-model="form.password"
                            placeholder="New password"
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
                            autocomplete="new-password"
                            v-model="form.password_confirmation"
                            placeholder="Confirm password"
                            :invalid="!!form.errors.password_confirmation"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <CButton type="submit" color="primary" :disabled="form.processing">Save password</CButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="mb-0 text-muted">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
