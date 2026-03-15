<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { onUnmounted, ref } from 'vue';
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/security';
import { disable, enable } from '@/routes/two-factor';
import { update } from '@/routes/user-password';
import type { BreadcrumbItem } from '@/types';

type Props = {
    canManageTwoFactor?: boolean;
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
};

withDefaults(defineProps<Props>(), {
    canManageTwoFactor: false,
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Security settings',
        href: edit(),
    },
];

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => clearTwoFactorAuthData());
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Security settings" />

        <h1 class="visually-hidden">Security settings</h1>

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
                            <Label for="current_password"
                                >Current password</Label
                            >
                            <PasswordInput
                                id="current_password"
                                name="current_password"
                                required
                                :tabindex="1"
                                autocomplete="current-password"
                                :invalid="!!errors.current_password"
                                placeholder="Current password"
                            />
                            <InputError :message="errors.current_password" />
                        </div>

                        <div class="d-grid">
                            <Label for="password">New password</Label>
                            <PasswordInput
                                id="password"
                                name="password"
                                required
                                :tabindex="2"
                                autocomplete="new-password"
                                :invalid="!!errors.password"
                                placeholder="New password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="d-grid">
                            <Label for="password_confirmation">
                                Confirm password
                            </Label>
                            <PasswordInput
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                :tabindex="3"
                                autocomplete="new-password"
                                :invalid="!!errors.password_confirmation"
                                placeholder="Confirm password"
                            />
                            <InputError
                                :message="errors.password_confirmation"
                            />
                        </div>
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
                </Form>

                <template v-if="canManageTwoFactor">
                    <Heading
                        variant="small"
                        title="Two-factor authentication"
                        description="Manage your two-factor authentication settings"
                    />

                    <div
                        v-if="!twoFactorEnabled"
                        class="d-flex flex-column align-items-start justify-content-start gap-2"
                    >
                        <p class="mb-0 text-muted">
                            When you enable two-factor authentication, you will
                            be prompted for a secure pin during login. This pin
                            can be retrieved from a TOTP-supported application
                            on your phone.
                        </p>

                        <div>
                            <Button
                                v-if="hasSetupData"
                                @click="showSetupModal = true"
                            >
                                <Icon class="me-2" name="shield-check" />
                                Continue setup
                            </Button>

                            <Form
                                v-else
                                v-bind="enable.form()"
                                @success="showSetupModal = true"
                                v-slot="{ processing }"
                            >
                                <Button type="submit" :disabled="processing">
                                    <Icon class="me-2" name="shield-check" />
                                    Enable 2FA
                                </Button>
                            </Form>
                        </div>
                    </div>

                    <div
                        v-else
                        class="d-flex flex-column align-items-start justify-content-start gap-2"
                    >
                        <p class="mb-0 text-muted">
                            You will be prompted for a secure, random pin during
                            login, which you can retrieve from the
                            TOTP-supported application on your phone.
                        </p>

                        <Form v-bind="disable.form()" v-slot="{ processing }">
                            <Button
                                type="submit"
                                color="danger"
                                :disabled="processing"
                            >
                                <Icon class="me-2" name="shield-x" />
                                Disable 2FA
                            </Button>
                        </Form>

                        <TwoFactorRecoveryCodes class="mt-2" />
                    </div>

                    <TwoFactorSetupModal
                        v-model:isOpen="showSetupModal"
                        :requiresConfirmation="requiresConfirmation"
                        :twoFactorEnabled="twoFactorEnabled"
                    />
                </template>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
