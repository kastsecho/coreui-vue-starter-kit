<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { destroy as destroyInvitation } from '@/routes/teams/invitations';
import type { Team, TeamInvitation } from '@/types';

const props = defineProps<{
    team: Team;
    invitation: TeamInvitation | null;
}>();

const open = defineModel<boolean>('open');
const formKey = ref(0);

function handleOpenChange(value: boolean) {
    open.value = value;

    if (!value) {
        formKey.value++;
    }
}
</script>

<template>
    <Dialog
        content-class-name="rounded-4"
        :open="open"
        @close="handleOpenChange(false)"
    >
        <!-- @vue-ignore -->
        <Form
            :key="formKey"
            v-bind="
                destroyInvitation.form([
                    props.team.slug,
                    props.invitation?.code,
                ])
            "
            v-slot="{ processing }"
            @success="handleOpenChange(false)"
        >
            <DialogHeader class="d-grid">
                <DialogTitle>Cancel invitation</DialogTitle>
                <DialogDescription>
                    Are you sure you want to cancel the invitation for
                    <strong>{{ props.invitation?.email }}</strong
                    >?
                </DialogDescription>
            </DialogHeader>
            <DialogFooter>
                <Button
                    type="button"
                    color="secondary"
                    @click="() => (open = false)"
                >
                    Keep invitation
                </Button>

                <Button
                    type="submit"
                    data-test="cancel-invitation-confirm"
                    color="danger"
                    :disabled="!props.invitation || processing"
                >
                    Cancel invitation
                </Button>
            </DialogFooter>
        </Form>
    </Dialog>
</template>
