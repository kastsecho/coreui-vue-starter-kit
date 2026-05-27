<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
/* @chisel-passkeys */
import type { Props as ManagePasskeysProps } from '@/components/ManagePasskeys.vue';
import ManagePasskeys from '@/components/ManagePasskeys.vue';
/* @end-chisel-passkeys */
/* @chisel-2fa */
import type { Props as ManageTwoFactorProps } from '@/components/ManageTwoFactor.vue';
import ManageTwoFactor from '@/components/ManageTwoFactor.vue';
/* @end-chisel-2fa */
import { Button } from '@/components/ui/button';
import { InputFeedback, Label, PasswordInput } from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { edit } from '@/routes/security';
import { update } from '@/routes/user-password';

type Props = {
    passwordRules: string;
} /* @chisel-passkeys */ & ManagePasskeysProps /* @end-chisel-passkeys */ /* @chisel-2fa */ &
    ManageTwoFactorProps /* @end-chisel-2fa */;

const props = defineProps<Props>();

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Security settings',
            href: edit(),
        },
    ],
});
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

    <!-- @chisel-2fa -->
    <ManageTwoFactor
        :canManageTwoFactor="canManageTwoFactor"
        :requiresConfirmation="requiresConfirmation"
        :twoFactorEnabled="twoFactorEnabled"
    />
    <!-- @end-chisel-2fa -->

    <!-- @chisel-passkeys -->
    <ManagePasskeys
        :canManagePasskeys="canManagePasskeys"
        :passkeys="passkeys"
    />
    <!-- @end-chisel-passkeys -->
</template>
