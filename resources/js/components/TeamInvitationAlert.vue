<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { biInfoCircle } from '@/components/icon';
import { Alert, AlertDescription } from '@/components/ui/alert';
import type { TeamInvitationContext } from '@/types';

defineProps<{
    invitation: TeamInvitationContext;
    action: 'Log in' | 'Register';
}>();
</script>

<template>
    <Alert class="d-flex align-items-center gap-2" color="info">
        <CIconSvg>
            <biInfoCircle />
        </CIconSvg>
        <AlertDescription>
            {{ action }} to join the "{{ invitation.teamName }}" team.
        </AlertDescription>
    </Alert>
</template>
