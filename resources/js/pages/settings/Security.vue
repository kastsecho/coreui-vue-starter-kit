<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { onUnmounted, ref } from 'vue';
import Heading from '@/components/Heading.vue';
import { biShieldCheck, biShieldX } from '@/components/icon';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { InputFeedback, Label, PasswordInput } from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { edit } from '@/routes/security';
import { disable, enable } from '@/routes/two-factor';
import { update } from '@/routes/user-password';

type Props = {
    canManageTwoFactor?: boolean;
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
    passwordRules: string;
};

const props = withDefaults(defineProps<Props>(), {
    canManageTwoFactor: false,
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Security settings',
            href: edit(),
        },
    ],
});

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => clearTwoFactorAuthData());
</script>

<template>
    <Head title="Security settings" />

    <h1 class="visually-hidden">Security settings</h1>
    <div class="d-grid row-gap-3">
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
            reset-on-error
            v-slot="{ errors, processing }"
            error-bag="updatePassword"
            class="d-flex flex-column gap-3"
            novalidate
        >
            <div class="d-grid">
                <Label for="current_password">Current password</Label>
                <PasswordInput
                    id="current_password"
                    name="current_password"
                    autofocus
                    :tabindex="1"
                    autocomplete="current-password"
                    placeholder="Current password"
                    :invalid="!!errors.current_password"
                />
                <InputFeedback :message="errors.current_password" invalid />
            </div>

            <div class="d-grid">
                <Label for="password">New password</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    :tabindex="2"
                    autocomplete="new-password"
                    placeholder="New password"
                    :passwordrules="props.passwordRules"
                    :invalid="!!errors.password"
                />
                <InputFeedback :message="errors.password" invalid />
            </div>

            <div class="d-grid">
                <Label for="password_confirmation">Confirm password</Label>
                <PasswordInput
                    id="password_confirmation"
                    name="password_confirmation"
                    :tabindex="3"
                    autocomplete="new-password"
                    placeholder="Confirm password"
                    :passwordrules="props.passwordRules"
                    :invalid="!!errors.password_confirmation"
                />
                <InputFeedback
                    :message="errors.password_confirmation"
                    invalid
                />
            </div>

            <div class="d-flex align-items-center gap-4">
                <Button
                    type="submit"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="update-password-button"
                >
                    <Spinner v-if="processing" />
                    Save
                </Button>
            </div>
        </Form>
    </div>

    <div v-if="canManageTwoFactor" class="d-grid row-gap-3 mt-3">
        <Heading
            variant="small"
            title="Two-factor authentication"
            description="Manage your two-factor authentication settings"
        />

        <div
            v-if="!twoFactorEnabled"
            class="d-flex flex-column align-items-start justify-content-start gap-2"
        >
            <p class="text-muted small fw-semibold">
                When you enable two-factor authentication, you will be prompted
                for a secure pin during login. This pin can be retrieved from a
                TOTP-supported application on your phone.
            </p>

            <div>
                <Button v-if="hasSetupData" @click="showSetupModal = true">
                    <CIconSvg>
                        <biShieldCheck />
                    </CIconSvg>
                    Continue setup
                </Button>
                <Form
                    v-else
                    v-bind="enable.form()"
                    @success="showSetupModal = true"
                    #default="{ processing }"
                >
                    <Button type="submit" :disabled="processing">
                        <CIconSvg>
                            <biShieldCheck />
                        </CIconSvg>
                        Enable 2FA
                    </Button>
                </Form>
            </div>
        </div>

        <div
            v-else
            class="d-flex flex-column align-items-start justify-content-start gap-2"
        >
            <p class="text-muted small fw-semibold">
                You will be prompted for a secure, random pin during login,
                which you can retrieve from the TOTP-supported application on
                your phone.
            </p>

            <div class="relative inline">
                <Form v-bind="disable.form()" #default="{ processing }">
                    <Button type="submit" color="danger" :disabled="processing">
                        <CIconSvg>
                            <biShieldX />
                        </CIconSvg>
                        Disable 2FA
                    </Button>
                </Form>
            </div>

            <TwoFactorRecoveryCodes />
        </div>

        <TwoFactorSetupModal
            v-model:isOpen="showSetupModal"
            :requiresConfirmation="requiresConfirmation"
            :twoFactorEnabled="twoFactorEnabled"
        />
    </div>
</template>
