<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit as editPassword } from '@/routes/password';
import { edit as editProfile } from '@/routes/profile';
import { update } from '@/routes/user-password';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Settings',
        href: editProfile().url,
    },
    {
        title: 'Password settings',
        href: editPassword().url,
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall
                    title="Update password"
                    description="Ensure your account is using a long, random password to stay secure"
                />

                <Form
                    v-bind="update.form()"
                    :options="{
                        preserveScroll: true,
                    }"
                    reset-on-success
                    :reset-on-error="[
                        'password',
                        'password_confirmation',
                        'current_password',
                    ]"
                    v-slot="{ errors, processing, recentlySuccessful }"
                >
                    <div class="d-grid gap-3">
                        <div class="d-grid">
                            <Label for="current_password">Current password</Label>
                            <Input
                                ref="currentPasswordInput"
                                id="current_password"
                                type="password"
                                name="current_password"
                                required
                                :tabindex="1"
                                autocomplete="current-password"
                                autofocus
                                placeholder="Current password"
                                :invalid="!!errors.current_password"
                            />
                            <InputError :message="errors.current_password" />
                        </div>

                        <div class="d-grid">
                            <Label for="password">New password</Label>
                            <Input
                                ref="passwordInput"
                                id="password"
                                type="password"
                                name="password"
                                required
                                :tabindex="2"
                                autocomplete="new-password"
                                placeholder="New password"
                                :invalid="!!errors.password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="d-grid">
                            <Label for="password_confirmation"
                                >Confirm password</Label
                            >
                            <Input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                :tabindex="3"
                                autocomplete="new-password"
                                placeholder="Confirm password"
                                :invalid="!!errors.password_confirmation"
                            />
                            <InputError :message="errors.password_confirmation" />
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <Button
                                type="submit"
                                :tabindex="4"
                                :disabled="processing"
                                data-test="update-password-button"
                            >
                                Save password
                            </Button>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p
                                    v-show="recentlySuccessful"
                                    class="mb-0 text-muted"
                                >
                                    Saved.
                                </p>
                            </Transition>
                        </div>
                    </div>
                </Form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
