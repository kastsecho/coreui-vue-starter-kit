<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref, useTemplateRef } from 'vue';
import Heading from '@/components/Heading.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { destroy } from '@/routes/profile';

const showModal = ref<boolean>(false);
const passwordInput = useTemplateRef('passwordInput');
</script>

<template>
    <div class="d-grid gap-3">
        <Heading
            variant="small"
            title="Delete account"
            description="Delete your account and all of its resources"
        />

        <Alert class="rounded-4 shadow-sm" color="danger">
            <AlertTitle class="fs-5 fw-medium">Warning</AlertTitle>
            <AlertDescription>
                Please proceed with caution, this cannot be undone.
            </AlertDescription>

            <Button
                class="mt-2"
                type="button"
                color="danger"
                @click="showModal = true"
                data-test="delete-user-button"
            >
                Delete account
            </Button>
        </Alert>

        <Dialog
            content-class-name="rounded-4"
            :open="showModal"
            @close="showModal = false"
        >
            <Form
                v-bind="destroy.form()"
                reset-on-success
                @error="() => passwordInput?.focus()"
                :options="{
                    preserveScroll: true,
                }"
                v-slot="{ errors, processing, reset, clearErrors }"
            >
                <DialogHeader class="d-grid">
                    <DialogTitle>
                        Are you sure you want to delete your account?
                    </DialogTitle>
                    <DialogDescription>
                        Once your account is deleted, all of its resources and
                        data will also be permanently deleted. Please enter your
                        password to confirm you would like to permanently delete
                        your account.
                    </DialogDescription>
                </DialogHeader>
                <DialogContent>
                    <div class="grid gap-2">
                        <Label for="password" class="visually-hidden">
                            Password
                        </Label>
                        <PasswordInput
                            id="password"
                            name="password"
                            ref="passwordInput"
                            placeholder="Password"
                        />
                        <InputError :message="errors.password" />
                    </div>
                </DialogContent>
                <DialogFooter class="gap-2">
                    <Button
                        color="secondary"
                        @click="
                            () => {
                                showModal = false;
                                clearErrors();
                                reset();
                            }
                        "
                    >
                        Cancel
                    </Button>

                    <Button
                        type="submit"
                        color="danger"
                        data-test="confirm-delete-user-button"
                        :disabled="processing"
                    >
                        Delete account
                    </Button>
                </DialogFooter>
            </Form>
        </Dialog>
    </div>
</template>
