<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Checkbox, Input, InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();

setLayoutProps({
    title: 'Log in to your account',
    description: 'Enter your email and password below to log in',
});
</script>

<template>
    <Head title="Log in" />

    <Alert
        v-if="status"
        color="success"
        class="text-center fw-medium rounded-4 shadow-sm"
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
                    :tabindex="1"
                    autocomplete="email"
                    autofocus
                    :invalid="!!errors.email"
                    placeholder="email@example.com"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="d-grid">
                <div
                    class="form-label d-flex align-items-center justify-content-between"
                >
                    <Label class="mb-0" for="password">Password</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-sm"
                        :tabindex="5"
                    >
                        Forgot password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    :invalid="!!errors.password"
                    placeholder="Password"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="form-check">
                <Label for="remember" custom-class-name="form-check-label">
                    <Checkbox id="remember" name="remember" :tabindex="3" />
                    <span>Remember me</span>
                </Label>
            </div>

            <Button
                type="submit"
                class="mt-2"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                Log in
            </Button>
        </div>

        <div v-if="canRegister" class="text-center text-muted">
            Don't have an account?
            <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
        </div>
    </Form>
</template>
