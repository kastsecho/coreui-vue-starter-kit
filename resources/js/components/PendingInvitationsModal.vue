<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { accept, decline } from '@/routes/invitations';
import type { DashboardInvitation } from '@/types';
import {Card, CardContent} from "@/components/ui/card";

const props = defineProps<{
    invitations: DashboardInvitation[];
}>();

const open = ref(false);
const processingCode = ref<string | null>(null);

const acceptInvitation = (invitation: DashboardInvitation) => {
    router.visit(accept(invitation), {
        onStart: () => (processingCode.value = invitation.code),
        onFinish: () => (processingCode.value = null),
    });
};

const declineInvitation = (invitation: DashboardInvitation) => {
    router.visit(decline(invitation), {
        onStart: () => (processingCode.value = invitation.code),
        onFinish: () => (processingCode.value = null),
        onSuccess: () => {
            if (props.invitations.length === 1) {
                open.value = false;
            }
        },
    });
};

onMounted(() => {
    open.value = true;
});
</script>

<template>
    <Dialog
        content-class-name="rounded-4"
        :open="open"
        @close="open = false"
        data-test="pending-invitations-modal"
    >
        <DialogHeader class="d-grid" :close-button="false">
            <DialogTitle>Pending team invitations</DialogTitle>
            <DialogDescription text-color="body-secondary">
                Accept or decline the teams you have been invited to join.
            </DialogDescription>
        </DialogHeader>

        <DialogContent class="d-grid gap-3">
            <Card
                v-for="invitation in props.invitations"
                :key="invitation.code"
                class="rounded-4"
                data-test="pending-invitation-row"
            >
                <CardContent class="d-grid gap-2">
                    <div class="d-grid gap-1">
                        <p class="mb-0 fw-medium">{{ invitation.team.name }}</p>
                        <p class="mb-0 text-body-secondary">
                            {{ invitation.inviterName }} invited you to join
                            this team.
                        </p>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <Button
                            color="danger"
                            data-test="pending-invitation-decline"
                            :disabled="processingCode === invitation.code"
                            @click="declineInvitation(invitation)"
                        >
                            Decline
                        </Button>

                        <Button
                            color="light"
                            data-test="pending-invitation-accept"
                            :disabled="processingCode === invitation.code"
                            @click="acceptInvitation(invitation)"
                        >
                            Accept
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </DialogContent>
    </Dialog>
</template>
