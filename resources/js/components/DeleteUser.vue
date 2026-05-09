<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref, useTemplateRef } from 'vue';
import Heading from '@/components/Heading.vue';
import { Alert, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { InputFeedback, Label, PasswordInput } from '@/components/ui/form';
import { destroy } from '@/routes/profile';

const passwordInput = useTemplateRef('passwordInput');
const showDeleteModal = ref<boolean>(false);
</script>

<template>
    <div class="d-grid row-gap-3">
        <Heading
            variant="small"
            title="Delete account"
            description="Delete your account and all of its resources"
        />
        <Alert class="rounded-4" color="danger">
            <AlertTitle as="h5" class="fw-semibold">Warning</AlertTitle>
            <p class="small fw-medium">
                Please proceed with caution, this cannot be undone.
            </p>
            <Button
                color="danger"
                data-test="delete-user-button"
                @click="showDeleteModal = true"
            >
                Delete account
            </Button>
        </Alert>

        <Dialog
            content-class-name="rounded-4"
            :open="showDeleteModal"
            @close="showDeleteModal = false"
        >
            <Form
                v-bind="destroy.form()"
                reset-on-success
                @error="() => passwordInput?.focus()"
                :options="{
                    preserveScroll: true,
                }"
                v-slot="{ errors, processing, resetAndClearErrors }"
            >
                <DialogHeader class="d-grid row-gap-3" :close-button="false">
                    <DialogTitle>
                        Are you sure you want to delete your account?
                    </DialogTitle>
                    <DialogDescription text-color="secondary">
                        Once your account is deleted, all of its resources and
                        data will also be permanently deleted. Please enter your
                        password to confirm you would like to permanently delete
                        your account.
                    </DialogDescription>
                </DialogHeader>

                <DialogContent>
                    <div class="d-grid">
                        <Label for="password" class="visually-hidden">
                            Password
                        </Label>
                        <PasswordInput
                            ref="passwordInput"
                            id="password"
                            name="password"
                            placeholder="Password"
                            :invalid="!!errors.password"
                        />
                        <InputFeedback :message="errors.password" invalid />
                    </div>
                </DialogContent>

                <DialogFooter class="gap-2">
                    <Button
                        color="secondary"
                        @click="
                            () => {
                                showDeleteModal = false;
                                resetAndClearErrors();
                            }
                        "
                    >
                        Cancel
                    </Button>

                    <Button
                        type="submit"
                        color="danger"
                        :disabled="processing"
                        data-test="confirm-delete-user-button"
                    >
                        Delete account
                    </Button>
                </DialogFooter>
            </Form>
        </Dialog>
    </div>
</template>
