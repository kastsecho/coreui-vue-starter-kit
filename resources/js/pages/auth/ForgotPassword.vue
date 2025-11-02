<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Forgot password"
        description="Enter your email to receive a password reset link"
    >
        <Head title="Forgot password" />

        <Alert
            v-if="status"
            class="text-center fw-medium rounded-4 shadow-sm"
            color="success"
        >
            {{ status }}
        </Alert>

        <Form
            v-bind="email.form()"
            reset-on-success
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
                        :tabindex="1"
                        autocomplete="off"
                        autofocus
                        placeholder="email@example.com"
                        :invalid="!!errors.email"
                    />
                    <InputError :message="errors.email" />
                </div>

                <Button
                    type="submit"
                    :tabindex="2"
                    :disabled="processing"
                    data-test="email-password-reset-link-button"
                >
                    <Spinner v-if="processing" size="sm" />
                    Email password reset link
                </Button>
            </div>

            <div class="d-flex gap-1 justify-content-center text-muted">
                <span>Or, return to</span>
                <TextLink :href="login()" :tabindex="3">log in</TextLink>
            </div>
        </Form>
    </AuthLayout>
</template>
