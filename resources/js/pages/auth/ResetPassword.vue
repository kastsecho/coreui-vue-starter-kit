<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { ref } from 'vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Input, InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { update } from '@/routes/password';

const props = defineProps<{
    token: string;
    email: string;
}>();

setLayoutProps({
    title: 'Reset password',
    description: 'Please enter your new password below',
});

const inputEmail = ref(props.email);
</script>

<template>
    <Head title="Reset password" />

    <Form
        v-bind="update.form()"
        :transform="(data) => ({ ...data, token, email })"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
        class="d-flex flex-column gap-3"
    >
        <div class="d-grid gap-3">
            <div class="d-grid">
                <Label for="email">Email</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    :invalid="!!errors.email"
                    :tabindex="1"
                    autocomplete="email"
                    placeholder="email@example.com"
                    v-model="inputEmail"
                    disabled
                />
                <InputError :message="errors.email" />
            </div>

            <div class="d-grid">
                <Label for="password">Password</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="new-password"
                    autofocus
                    :invalid="!!errors.password"
                    placeholder="Password"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="d-grid">
                <Label for="password_confirmation">Confirm password</Label>
                <PasswordInput
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    :tabindex="3"
                    autocomplete="new-password"
                    :invalid="!!errors.password_confirmation"
                    placeholder="Confirm password"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <Button
                type="submit"
                class="mt-2"
                :tabindex="4"
                :disabled="processing"
                data-test="reset-password-button"
            >
                <Spinner v-if="processing" />
                Reset password
            </Button>
        </div>
    </Form>
</template>
