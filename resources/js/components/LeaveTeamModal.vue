<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { leave as leaveTeamAction } from '@/routes/teams';
import type { Team } from '@/types';

const props = defineProps<{
    team: Team | null;
}>();

const open = defineModel<boolean>('open');
const processing = ref(false);

const leaveTeam = () => {
    if (!props.team) {
        return;
    }

    router.visit(leaveTeamAction(props.team.slug), {
        onStart: () => (processing.value = true),
        onFinish: () => (processing.value = false),
    });
};
</script>

<template>
    <Dialog
        content-class-name="rounded-4"
        :open="open"
        @close="open = false"
    >
        <DialogHeader class="d-grid" :close-button="false">
            <DialogTitle>Leave team</DialogTitle>
            <DialogDescription text-color="body-secondary">
                Are you sure you want to leave
                <strong>{{ props.team?.name }}</strong>?
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
                data-test="leave-team-confirm"
                color="danger"
                :disabled="processing"
                @click="leaveTeam"
            >
                Leave team
            </Button>
        </DialogFooter>
    </Dialog>
</template>
