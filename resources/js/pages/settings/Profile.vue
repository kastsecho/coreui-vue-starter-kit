<script setup lang="ts">
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import { edit } from '@/routes/profile';
import { update } from '@/routes/user-profile-information';
import { send } from '@/routes/verification';
import { Form, Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    mustVerifyEmail: boolean;
    status?: string;
}>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Settings',
        href: edit().url,
    },
    {
        title: 'Profile settings',
        href: edit().url,
    },
];

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall
                    title="Profile information"
                    description="Update your name and email address"
                />

                <Form
                    v-bind="update.form()"
                    class="space-y-6"
                    v-slot="{ errors, processing, recentlySuccessful }"
                >
                    <div class="d-grid gap-3">
                        <div class="d-grid">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                name="name"
                                required
                                :tabindex="1"
                                autocomplete="name"
                                autofocus
                                placeholder="Full name"
                                :model-value="user.name"
                            />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="d-grid">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                required
                                :tabindex="2"
                                autocomplete="username"
                                placeholder="Email address"
                                :model-value="user.email"
                            />
                            <InputError :message="errors.email" />
                        </div>

                        <div v-if="mustVerifyEmail && !user.email_verified_at">
                            <p class="-mt-4 text-sm text-muted-foreground">
                                Your email address is unverified.
                                <TextLink
                                    class="btn btn-link"
                                    :href="send()"
                                    :tabindex="3"
                                    as="button"
                                >
                                    Click here to resend the verification email.
                                </TextLink>
                            </p>

                            <Alert
                                v-if="status === 'verification-link-sent'"
                                class="fw-medium rounded-4 shadow-sm"
                                color="success"
                            >
                                A new verification link has been sent to your email
                                address.
                            </Alert>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <Button
                                type="submit"
                                :tabindex="4"
                                :disabled="processing"
                                data-test="update-profile-button"
                            >
                                Save
                            </Button>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p
                                    v-show="recentlySuccessful"
                                    class="text-sm text-neutral-600"
                                >
                                    Saved.
                                </p>
                            </Transition>
                        </div>
                    </div>
                </Form>

                <DeleteUser />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
