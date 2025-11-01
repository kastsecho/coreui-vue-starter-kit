<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';
import { send } from '@/routes/verification';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Verify email"
        description="Please verify your email address by clicking on the link we just emailed to you."
    >
        <Head title="Email verification" />

        <Alert
            v-if="status === 'verification-link-sent'"
            class="text-center fw-medium rounded-4 shadow-sm"
            color="success"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </Alert>

        <Form
            v-bind="send.form()"
            v-slot="{ processing }"
            class="d-flex gap-3 justify-content-center"
        >
            <Button
                type="submit"
                :tabindex="1"
                :disabled="processing"
                data-test="verify-email-button"
            >
                <Spinner v-if="processing" size="sm" />
                Resend verification email
            </Button>

            <TextLink
                class="btn btn-link"
                as="button"
                :href="logout()"
                :tabindex="2"
            >
                Log out
            </TextLink>
        </Form>
    </AuthLayout>
</template>
