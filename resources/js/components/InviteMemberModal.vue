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
import { Input, InputError, Select } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { store as storeInvitation } from '@/routes/teams/invitations';
import type { RoleOption, Team } from '@/types';

const props = defineProps<{
    team: Team;
    availableRoles: RoleOption[];
}>();

const open = defineModel<boolean>('open');

const inviteRole = ref('member');
const formKey = ref(0);

function handleOpenChange(value: boolean) {
    open.value = value;

    if (!value) {
        inviteRole.value = 'member';
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
        <Form
            :key="formKey"
            v-bind="storeInvitation.form(props.team.slug)"
            v-slot="{ errors, processing, resetAndClearErrors }"
            @success="open = false"
        >
            <DialogHeader class="d-grid">
                <DialogTitle>Invite a team member</DialogTitle>
                <DialogDescription>
                    Send an invitation to join this team.
                </DialogDescription>
            </DialogHeader>
            <DialogContent class="d-grid gap-3">
                <div class="d-grid">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        name="email"
                        data-test="invite-email"
                        type="email"
                        placeholder="colleague@example.com"
                        required
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="d-grid">
                    <Label for="role">Role</Label>
                    <Select
                        v-model="inviteRole"
                        name="role"
                        data-test="invite-role"
                    >
                        <option value="" disabled>Select a role</option>
                        <option
                            v-for="role in props.availableRoles"
                            :key="role.value"
                            :value="role.value"
                        >
                            {{ role.label }}
                        </option>
                    </Select>
                    <InputError :message="errors.role" />
                </div>
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
                    data-test="create-team-submit"
                    :disabled="processing"
                >
                    Send invitation
                </Button>
            </DialogFooter>
        </Form>
    </Dialog>
</template>
