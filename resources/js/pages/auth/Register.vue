<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import {
    Input,
    InputFeedback,
    Label,
    PasswordInput,
} from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineProps<{
    passwordRules: string;
}>();

setLayoutProps({
    title: 'Create an account',
    description: 'Enter your details below to create your account',
});
</script>

<template>
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
                    autofocus
                    :tabindex="1"
                    autocomplete="name"
                    placeholder="Full name"
                    :invalid="!!errors.name"
                />
                <InputFeedback :message="errors.name" invalid />
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
                <InputFeedback :message="errors.email" invalid />
            </div>

            <div class="d-grid">
                <Label for="password">Password</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="3"
                    autocomplete="new-password"
                    placeholder="Password"
                    :passwordrules="passwordRules"
                    :invalid="!!errors.password"
                />
                <InputFeedback :message="errors.password" invalid />
            </div>

            <div class="d-grid">
                <Label for="password_confirmation">Confirm password</Label>
                <PasswordInput
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    :tabindex="4"
                    autocomplete="new-password"
                    placeholder="Confirm password"
                    :passwordrules="passwordRules"
                    :invalid="!!errors.password_confirmation"
                />
                <InputFeedback
                    :message="errors.password_confirmation"
                    invalid
                />
            </div>

            <Button
                type="submit"
                class="mt-4"
                :tabindex="5"
                :disabled="processing"
                data-test="register-user-button"
            >
                <Spinner v-if="processing" />
                Create account
            </Button>
        </div>

        <div class="text-muted text-center">
            Already have an account?
            <TextLink :href="login()" :tabindex="6">Log in</TextLink>
        </div>
    </Form>
</template>
