<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Checkbox, Input, InputError, Label } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    canRegister: boolean;
    canResetPassword: boolean;
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <Alert
            v-if="status"
            class="text-center fw-medium rounded-4 shadow-sm"
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
                        :tabindex="1"
                        autocomplete="email"
                        autofocus
                        placeholder="email@example.com"
                        :invalid="!!errors.email"
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
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                        :invalid="!!errors.password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="form-check">
                    <Label custom-class-name="form-check-label" for="remember">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" size="sm" />
                    Log in
                </Button>
            </div>

            <div
                v-if="canRegister"
                class="d-flex gap-1 justify-content-center text-muted"
            >
                <span>Don't have an account?</span>
                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
            </div>
        </Form>
    </AuthLayout>
</template>
