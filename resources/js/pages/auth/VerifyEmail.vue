<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import { logout } from '@/routes';
import { send } from '@/routes/verification';

setLayoutProps({
    title: 'Verify email',
    description:
        'Please verify your email address by clicking on the link we just emailed to you.',
});

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Email verification" />

    <Alert
        v-if="status === 'verification-link-sent'"
        color="success"
        class="fw-medium text-center"
    >
        A new verification link has been sent to the email address you provided
        during registration.
    </Alert>

    <Form
        v-bind="send.form()"
        v-slot="{ processing }"
        class="d-flex justify-content-center gap-3"
    >
        <Button
            type="submit"
            color="secondary"
            :tabindex="1"
            :disabled="processing"
        >
            <Spinner v-if="processing" />
            Resend verification email
        </Button>

        <TextLink
            :href="logout()"
            :tabindex="2"
            as="button"
            class="btn btn-link"
        >
            Log out
        </TextLink>
    </Form>
</template>
