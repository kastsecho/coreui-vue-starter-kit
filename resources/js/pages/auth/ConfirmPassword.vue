<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm';
</script>

<template>
    <AuthLayout
        title="Confirm your password"
        description="This is a secure area of the application. Please confirm your password before continuing."
    >
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
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autofocus
                        :invalid="!!errors.email"
                        :tabindex="1"
                        autocomplete="current-password"
                        placeholder="Password"
                    />

                    <InputError :message="errors.password" />
                </div>

                <Button
                    type="submit"
                    class="mt-2"
                    :tabindex="2"
                    :disabled="processing"
                    data-test="confirm-password-button"
                >
                    <Spinner v-if="processing" />
                    Confirm password
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
