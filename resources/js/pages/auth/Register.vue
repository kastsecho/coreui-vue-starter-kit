<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { CSpinner } from '@coreui/vue';
import { Form, Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthLayout
        title="Create an account"
        description="Enter your details below to create your account"
    >
        <Head title="Register" />

        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="d-flex flex-column gap-3"
        >
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <Label for="name">Name</Label>
                    <Input
                        id="name"
                        type="text"
                        name="name"
                        required
                        :tabindex="1"
                        autocomplete="name"
                        autofocus
                        placeholder="Full name"
                        :invalid="!!errors.name"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="d-grid">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        placeholder="email@example.com"
                        :invalid="!!errors.email"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="d-grid">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        placeholder="Password"
                        :invalid="!!errors.password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="d-grid">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        placeholder="Confirm password"
                        :invalid="!!errors.password_confirmation"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    :tabindex="5"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <CSpinner
                        v-if="processing"
                        size="sm"
                    />
                    Create account
                </Button>
            </div>

            <div
                class="d-flex gap-1 justify-content-center text-muted"
            >
                <span>Already have an account?</span>
                <TextLink :href="login()" :tabindex="6">Log in</TextLink>
            </div>
        </Form>
    </AuthLayout>
</template>
