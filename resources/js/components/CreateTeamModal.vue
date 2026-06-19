<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input, InputFeedback, Label } from '@/components/ui/form';
import { store } from '@/routes/teams';

const open = ref(false);
const formKey = ref(0);

function handleOpenChange(value: boolean) {
    open.value = value;

    if (!value) {
        formKey.value++;
    }
}

const showModal = () => handleOpenChange(true);
</script>

<template>
    <span class="flex-shrink-0">
        <slot :showModal="showModal" />
    </span>

    <Dialog
        content-class-name="rounded-4"
        :open="open"
        @close="handleOpenChange(false)"
    >
        <Form
            :key="formKey"
            v-bind="store.form()"
            v-slot="{ errors, processing, resetAndClearErrors }"
            @success="open = false"
        >
            <DialogHeader class="d-grid" :close-button="false">
                <DialogTitle>Create a new team</DialogTitle>
                <DialogDescription text-color="body-secondary">
                    Create a new team to collaborate with others.
                </DialogDescription>
            </DialogHeader>
            <DialogContent>
                <Label for="name">Team name</Label>
                <Input
                    id="name"
                    name="name"
                    data-test="create-team-name"
                    placeholder="My team"
                    required
                    :invalid="!!errors.name"
                />
                <InputFeedback :message="errors.name" invalid />
            </DialogContent>
            <DialogFooter class="gap-2">
                <Button
                    color="secondary"
                    @click="
                        () => {
                            open = false;
                            resetAndClearErrors();
                        }
                    "
                >
                    Cancel
                </Button>

                <Button
                    type="submit"
                    color="primary"
                    data-test="create-team-submit"
                    :disabled="processing"
                >
                    Create team
                </Button>
            </DialogFooter>
        </Form>
    </Dialog>
</template>
