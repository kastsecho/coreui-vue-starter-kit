<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm';
import { Form, Head } from '@inertiajs/vue3';
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
        >
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="1"
                        autocomplete="current-password"
                        autofocus
                        placeholder="Password"
                        :invalid="!!errors.password"
                    />

                    <InputError :message="errors.password" />
                </div>

                <Button
                    type="submit"
                    :tabindex="2"
                    :disabled="processing"
                    data-test="confirm-password-button"
                >
                    <Spinner v-if="processing" size="sm" />
                    Confirm Password
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
