<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input, InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { destroy } from '@/routes/teams';
import type { Team } from '@/types';

const props = defineProps<{
    team: Team;
}>();

const open = defineModel<boolean>('open');
const confirmationName = ref('');
const formKey = ref(0);

const canDeleteTeam = computed(() => {
    return confirmationName.value === props.team.name;
});

const handleOpenChange = (value: boolean) => {
    open.value = value;

    if (!value) {
        confirmationName.value = '';
        formKey.value++;
    }
};
</script>

<template>
    <Dialog
        content-class-name="rounded-4"
        :open="open"
        @close="handleOpenChange(false)"
    >
        <Form
            :key="formKey"
            v-bind="destroy.form(props.team.slug)"
            v-slot="{ errors, processing, resetAndClearErrors }"
            @success="handleOpenChange(false)"
        >
            <DialogHeader class="d-grid">
                <DialogTitle>Are you sure?</DialogTitle>
                <DialogDescription>
                    This action cannot be undone. This will permanently delete
                    the team
                    <strong>"{{ props.team.name }}"</strong>.
                </DialogDescription>
            </DialogHeader>
            <DialogContent>
                <Label for="confirmation-name">
                    Type
                    <strong>"{{ props.team.name }}"</strong> to confirm
                </Label>
                <Input
                    id="confirmation-name"
                    name="name"
                    data-test="delete-team-name"
                    v-model="confirmationName"
                    placeholder="Enter team name"
                    autocomplete="off"
                />
                <InputError :message="errors.name" />
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
                    data-test="delete-team-confirm"
                    color="danger"
                    :disabled="!canDeleteTeam || processing"
                >
                    Delete team
                </Button>
            </DialogFooter>
        </Form>
    </Dialog>
</template>
