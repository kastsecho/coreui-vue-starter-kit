<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import {
    Checkbox,
    Input,
    InputFeedback,
    Label,
    PasswordInput,
} from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

setLayoutProps({
    title: 'Log in to your account',
    description: 'Enter your email and password below to log in',
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <Alert
        v-if="status"
        class="fw-medium rounded-4 text-center shadow-sm"
        color="success"
    >
        {{ status }}
    </Alert>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
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
                    autocomplete="email"
                    placeholder="email@example.com"
                    :invalid="!!errors.email"
                />
                <InputFeedback :message="errors.email" invalid />
            </div>

            <div class="d-grid">
                <div
                    class="d-flex align-items-center justify-content-between col-form-label"
                >
                    <Label class="mb-0" for="password">Password</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        :tabindex="5"
                    >
                        Forgot your password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Password"
                    :invalid="!!errors.password"
                />
                <InputFeedback :message="errors.password" invalid />
            </div>

            <div class="d-grid">
                <Checkbox
                    id="remember"
                    name="remember"
                    label="Remember me"
                    :tabindex="3"
                />
            </div>

            <Button
                type="submit"
                class="mt-4"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                Log in
            </Button>
        </div>

        <div v-if="canRegister" class="text-muted text-center">
            Don't have an account?
            <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
        </div>
    </Form>
</template>
