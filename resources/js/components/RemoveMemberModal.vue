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
import { destroy as destroyMember } from '@/routes/teams/members';
import type { Team, TeamMember } from '@/types';

const props = defineProps<{
    team: Team;
    member: TeamMember | null;
}>();

const open = defineModel<boolean>('open');
const formKey = ref(0);

const handleOpenChange = (value: boolean) => {
    open.value = value;

    if (!value) {
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
        <!-- @vue-ignore -->
        <Form
            :key="formKey"
            v-bind="destroyMember.form([props.team.slug, props.member?.id])"
            v-slot="{ processing }"
            @success="handleOpenChange(false)"
        >
            <DialogHeader class="d-grid">
                <DialogTitle>Remove team member</DialogTitle>
                <DialogDescription>
                    Are you sure you want to remove
                    <strong>{{ props.member?.name }}</strong> from this team?
                </DialogDescription>
            </DialogHeader>
            <DialogFooter class="gap-2">
                <Button
                    type="button"
                    color="secondary"
                    @click="() => (open = false)"
                >
                    Cancel
                </Button>

                <Button
                    type="submit"
                    data-test="cancel-invitation-confirm"
                    color="danger"
                    :disabled="!props.member || processing"
                >
                    Remove member
                </Button>
            </DialogFooter>
        </Form>
    </Dialog>
</template>
