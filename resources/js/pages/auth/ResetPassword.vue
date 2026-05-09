<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Input,
    InputFeedback,
    Label,
    PasswordInput,
} from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { update } from '@/routes/password';

setLayoutProps({
    title: 'Reset password',
    description: 'Please enter your new password below',
});

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <Head title="Reset password" />

    <Form
        v-bind="update.form()"
        :transform="(data) => ({ ...data, token, email })"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
    >
        <div class="d-grid gap-3">
            <div class="d-grid">
                <Label for="email">Email</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    v-model="inputEmail"
                    disabled
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
                    autofocus
                    :tabindex="1"
                    autocomplete="new-password"
                    placeholder="Password"
                    :invalid="!!errors.password"
                />
                <InputFeedback :message="errors.password" invalid />
            </div>

            <div class="d-grid">
                <Label for="password_confirmation"> Confirm password </Label>
                <PasswordInput
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    :tabindex="2"
                    autocomplete="new-password"
                    placeholder="Confirm password"
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
                :tabindex="3"
                :disabled="processing"
                data-test="reset-password-button"
            >
                <Spinner v-if="processing" />
                Reset password
            </Button>
        </div>
    </Form>
</template>
