<script setup lang="ts">
import { Form, Head, router, setLayoutProps } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import CancelInvitationModal from '@/components/CancelInvitationModal.vue';
import DeleteTeamModal from '@/components/DeleteTeamModal.vue';
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import InviteMemberModal from '@/components/InviteMemberModal.vue';
import RemoveMemberModal from '@/components/RemoveMemberModal.vue';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Input, InputError } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { ListGroup, ListGroupItem } from '@/components/ui/list-group';
import { Tooltip } from '@/components/ui/tooltip';
import { useInitials } from '@/composables/useInitials';
import { edit, index, update } from '@/routes/teams';
import { update as updateMember } from '@/routes/teams/members';
import type {
    RoleOption,
    Team,
    TeamInvitation,
    TeamMember,
    TeamPermissions,
} from '@/types';

const props = defineProps<{
    team: Team;
    members: TeamMember[];
    invitations: TeamInvitation[];
    permissions: TeamPermissions;
    availableRoles: RoleOption[];
}>();

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Teams',
            href: index(),
        },
        {
            title: computed(() => props.team.name),
            href: edit(props.team.slug),
        },
    ],
});

const { getInitials } = useInitials();

const inviteDialogOpen = ref(false);
const deleteDialogOpen = ref(false);
const removeMemberDialogOpen = ref(false);
const memberToRemove = ref<TeamMember | null>(null);
const cancelInvitationDialogOpen = ref(false);
const invitationToCancel = ref<TeamInvitation | null>(null);

const pageTitle = computed(() =>
    props.permissions.canUpdateTeam
        ? `Edit ${props.team.name}`
        : `View ${props.team.name}`,
);

const updateMemberRole = (member: TeamMember, newRole: string) => {
    router.visit(updateMember([props.team.slug, member.id]), {
        data: { role: newRole },
        preserveScroll: true,
    });
};

const confirmRemoveMember = (member: TeamMember) => {
    memberToRemove.value = member;
    removeMemberDialogOpen.value = true;
};

const confirmCancelInvitation = (invitation: TeamInvitation) => {
    invitationToCancel.value = invitation;
    cancelInvitationDialogOpen.value = true;
};
</script>

<template>
    <Head :title="pageTitle" />

    <h1 class="visually-hidden">{{ pageTitle }}</h1>

    <div class="d-flex flex-column gap-3">
        <!-- Team Name Section -->
        <div v-if="permissions.canUpdateTeam" class="d-grid gap-3">
            <Heading
                variant="small"
                title="Team settings"
                description="Update your team name and settings"
            />

            <Form
                v-bind="update.form(team.slug)"
                class="d-flex flex-column gap-3"
                v-slot="{ errors, processing }"
            >
                <div class="d-grid">
                    <Label for="name">Team name</Label>
                    <Input
                        id="name"
                        name="name"
                        data-test="team-name-input"
                        :model-value="team.name"
                        required
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="d-flex align-items-center gap-4">
                    <Button
                        type="submit"
                        data-test="team-save-button"
                        :disabled="processing"
                    >
                        Save
                    </Button>
                </div>
            </Form>
        </div>

        <div v-else class="d-grid gap-3">
            <Heading variant="small" :title="team.name" />
        </div>

        <!-- Members Section -->
        <div class="d-grid gap-3">
            <div class="d-flex align-items-center justify-content-between">
                <Heading
                    variant="small"
                    title="Team members"
                    :description="
                        permissions.canCreateInvitation
                            ? 'Manage who belongs to this team'
                            : ''
                    "
                />

                <Button
                    v-if="permissions.canCreateInvitation"
                    data-test="invite-member-button"
                    @click="inviteDialogOpen = true"
                >
                    <Icon name="person-plus" />
                    Invite member
                </Button>
            </div>

            <ListGroup class="rounded-4 shadow-sm">
                <ListGroupItem
                    v-for="member in members"
                    :key="member.id"
                    data-test="member-row"
                    class="d-flex align-items-center justify-content-between"
                >
                    <div class="d-flex align-items-center gap-4">
                        <AvatarImage
                            v-if="member.avatar"
                            :src="member.avatar"
                            :alt="member.name"
                        />
                        <AvatarFallback v-else>
                            {{ getInitials(member.name) }}
                        </AvatarFallback>
                        <div>
                            <div class="fw-medium">
                                {{ member.name }}
                            </div>
                            <div class="small text-muted">
                                {{ member.email }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <DropdownMenu
                            v-if="
                                member.role !== 'owner' &&
                                permissions.canUpdateMember
                            "
                            align="end"
                        >
                            <DropdownMenuTrigger>
                                {{ member.role_label }}
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem
                                    v-for="role in availableRoles"
                                    :key="role.value"
                                    data-test="member-role-option"
                                    @click="
                                        updateMemberRole(member, role.value)
                                    "
                                >
                                    {{ role.label }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                        <Badge v-else color="secondary">
                            {{ member.role_label }}
                        </Badge>

                        <Tooltip
                            v-if="
                                member.role !== 'owner' &&
                                permissions.canRemoveMember
                            "
                            v-slot="{ id, on }"
                            content="Remove member"
                            placement="top"
                        >
                            <Button
                                v-on="on"
                                data-test="member-remove-button"
                                color="danger"
                                variant="ghost"
                                size="sm"
                                :aria-describedby="id"
                                @click="confirmRemoveMember(member)"
                            >
                                <span class="visually-hidden">
                                    Remove member
                                </span>
                                <Icon name="x" />
                            </Button>
                        </Tooltip>
                    </div>
                </ListGroupItem>
            </ListGroup>
        </div>

        <!-- Pending Invitations Section -->
        <div v-if="invitations.length > 0" class="d-grid gap-3">
            <Heading
                variant="small"
                title="Pending invitations"
                description="Invitations that haven't been accepted yet"
            />

            <ListGroup class="rounded-4 shadow-sm">
                <ListGroupItem
                    v-for="invitation in invitations"
                    :key="invitation.code"
                    data-test="invitation-row"
                    class="d-flex align-items-center justify-content-between"
                >
                    <div class="d-flex align-items-center gap-4">
                        <Icon name="envelope" />
                        <div>
                            <div class="fw-medium">
                                {{ invitation.email }}
                            </div>
                            <div class="small text-muted">
                                {{ invitation.role_label }}
                            </div>
                        </div>
                    </div>
                    <Tooltip
                        v-if="permissions.canCancelInvitation"
                        v-slot="{ id, on }"
                        content="Cancel invitation"
                        placement="top"
                    >
                        <Button
                            v-on="on"
                            data-test="invitation-cancel-button"
                            color="danger"
                            variant="ghost"
                            size="sm"
                            :aria-describedby="id"
                            @click="confirmCancelInvitation(invitation)"
                        >
                            <span class="visually-hidden">
                                Cancel invitation
                            </span>
                            <Icon name="x" />
                        </Button>
                    </Tooltip>
                </ListGroupItem>
            </ListGroup>
        </div>

        <!-- Danger Zone -->
        <div
            v-if="permissions.canDeleteTeam && !team.isPersonal"
            class="d-grid gap-3"
        >
            <Heading
                variant="small"
                title="Delete team"
                description="Permanently delete your team"
            />
            <Alert color="danger" class="rounded-4 shadow-sm">
                <AlertTitle class="fs-5 fw-medium">Warning</AlertTitle>
                <AlertDescription>
                    Please proceed with caution, this cannot be undone.
                </AlertDescription>
                <Button
                    class="mt-2"
                    type="button"
                    color="danger"
                    @click="deleteDialogOpen = true"
                    data-test="delete-team-button"
                >
                    Delete team
                </Button>
            </Alert>
        </div>
    </div>

    <InviteMemberModal
        v-if="permissions.canCreateInvitation"
        :team="team"
        :available-roles="availableRoles"
        v-model:open="inviteDialogOpen"
    />

    <RemoveMemberModal
        :team="team"
        :member="memberToRemove"
        v-model:open="removeMemberDialogOpen"
    />

    <CancelInvitationModal
        :team="team"
        :invitation="invitationToCancel"
        v-model:open="cancelInvitationDialogOpen"
    />

    <DeleteTeamModal
        v-if="permissions.canDeleteTeam && !team.isPersonal"
        :team="team"
        v-model:open="deleteDialogOpen"
    />
</template>
