<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
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
import { Input, InputError, Label } from '@/components/ui/input';
import { destroy } from '@/routes/profile';
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<InstanceType<typeof Input> | null>(null);
const showDeleteModal = ref(false);
</script>

<template>
    <div class="d-grid gap-3">
        <HeadingSmall
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
                data-test="delete-user-button"
                @click="showDeleteModal = true"
            >
                Delete account
            </Button>

            <Dialog content-class-name="rounded-4" :open="showDeleteModal">
                <Form
                    v-bind="destroy.form()"
                    reset-on-success
                    @error="() => passwordInput?.$el?.focus()"
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
                            Once your account is deleted, all of its resources
                            and data will also be permanently deleted. Please
                            enter your password to confirm you would like to
                            permanently delete your account.
                        </DialogDescription>
                    </DialogHeader>

                    <DialogContent>
                        <div class="d-grid">
                            <Label for="password" class="visually-hidden">
                                Password
                            </Label>
                            <Input
                                ref="passwordInput"
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Password"
                                :invalid="!!errors.password"
                            />
                            <InputError :message="errors.password" />
                        </div>
                    </DialogContent>

                    <DialogFooter class="gap-2">
                        <Button
                            type="button"
                            color="secondary"
                            @click="
                                () => {
                                    clearErrors();
                                    reset();
                                    showDeleteModal = false;
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
        </Alert>
    </div>
</template>
