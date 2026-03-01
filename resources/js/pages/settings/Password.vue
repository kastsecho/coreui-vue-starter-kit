<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit, update } from '@/routes/user-password';
import type { BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Password settings',
        href: edit(),
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />

        <h1 class="visually-hidden">Password settings</h1>

        <SettingsLayout>
            <div class="d-flex flex-column gap-3">
                <Heading
                    variant="small"
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
                    class="d-flex flex-column gap-3"
                >
                    <div class="d-grid gap-3">
                        <div class="d-grid">
                            <Label for="current_password">
                                Current password
                            </Label>
                            <Input
                                id="current_password"
                                type="password"
                                name="current_password"
                                required
                                autofocus
                                :invalid="!!errors.current_password"
                                :tabindex="1"
                                autocomplete="current-password"
                                placeholder="Current password"
                            />
                            <InputError :message="errors.current_password" />
                        </div>

                        <div class="d-grid">
                            <Label for="password">New password</Label>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                required
                                :invalid="!!errors.password"
                                :tabindex="2"
                                autocomplete="new-password"
                                placeholder="New password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">
                                Confirm password
                            </Label>
                            <Input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                :invalid="!!errors.password_confirmation"
                                :tabindex="3"
                                autocomplete="new-password"
                                placeholder="Confirm password"
                            />
                            <InputError
                                :message="errors.password_confirmation"
                            />
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
