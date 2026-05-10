<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { InputFeedback, Label, PasswordInput } from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { store } from '@/routes/password/confirm';

setLayoutProps({
    title: 'Confirm your password',
    description:
        'This is a secure area of the application. Please confirm your password before continuing.',
});
</script>

<template>
    <Head title="Confirm password" />

    <Form
        v-bind="store.form()"
        reset-on-success
        v-slot="{ errors, processing }"
        class="d-flex flex-column gap-3"
    >
        <div class="d-grid gap-3">
            <div class="d-grid">
                <Label for="password">Password</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="1"
                    autocomplete="current-password"
                    placeholder="Password"
                    :invalid="!!errors.password"
                />
                <InputFeedback :message="errors.password" invalid />
            </div>

            <Button
                type="submit"
                class="mt-4"
                :tabindex="2"
                :disabled="processing"
                data-test="confirm-password-button"
            >
                <Spinner v-if="processing" />
                Confirm password
            </Button>
        </div>
    </Form>
</template>
