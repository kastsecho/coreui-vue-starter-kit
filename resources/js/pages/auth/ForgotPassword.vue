<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input, InputFeedback, Label } from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { email } from '@/routes/password';

setLayoutProps({
    title: 'Forgot password',
    description: 'Enter your email to receive a password reset link',
});

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Forgot password" />

    <Alert v-if="status" color="success" class="fw-medium text-center">
        {{ status }}
    </Alert>

    <Form
        v-bind="email.form()"
        v-slot="{ errors, processing }"
        class="d-flex flex-column gap-3"
    >
        <div class="d-grid gap-3">
            <div class="d-grid">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    :tabindex="1"
                    autocomplete="off"
                    placeholder="email@example.com"
                    :invalid="!!errors.email"
                />
                <InputFeedback :message="errors.email" invalid />
            </div>

            <Button
                type="submit"
                class="mt-4"
                :tabindex="2"
                :disabled="processing"
                data-test="email-password-reset-link-button"
            >
                <Spinner v-if="processing" />
                Email password reset link
            </Button>
        </div>

        <div class="text-muted text-center">
            Or, return to
            <TextLink :href="login()" :tabindex="3">log in</TextLink>
        </div>
    </Form>
</template>
