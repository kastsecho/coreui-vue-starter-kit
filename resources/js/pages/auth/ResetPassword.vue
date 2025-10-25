<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { update } from '@/routes/password';
import { CSpinner } from '@coreui/vue';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <AuthLayout
        title="Reset password"
        description="Please enter your new password below"
    >
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
                        :tabindex="1"
                        autocomplete="email"
                        v-model="inputEmail"
                        disabled
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
                        :tabindex="2"
                        autocomplete="new-password"
                        autofocus
                        placeholder="Password"
                        :invalid="!!errors.password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="d-grid">
                    <Label for="password_confirmation">
                        Confirm Password
                    </Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        placeholder="Confirm password"
                        :invalid="!!errors.password_confirmation"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="reset-password-button"
                >
                    <CSpinner
                        v-if="processing"
                        size="sm"
                    />
                    Reset password
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
