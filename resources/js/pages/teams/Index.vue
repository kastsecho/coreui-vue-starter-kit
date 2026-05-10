<script setup lang="ts">
import { cilPencil, cilPlus } from '@coreui/icons';
import { CIcon, CIconSvg } from '@coreui/icons-vue';
import { Head, setLayoutProps } from '@inertiajs/vue3';
import CreateTeamModal from '@/components/CreateTeamModal.vue';
import Heading from '@/components/Heading.vue';
import BiEye from '@/components/icon/biEye.vue';
import TextLink from '@/components/TextLink.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { ListGroup, ListGroupItem } from '@/components/ui/list-group';
import { Tooltip } from '@/components/ui/tooltip';
import { edit, index } from '@/routes/teams';
import type { Team } from '@/types';

defineProps<{
    teams: Team[];
}>();

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Teams',
            href: index(),
        },
    ],
});
</script>

<template>
    <Head title="Teams" />

    <h1 class="visually-hidden">Teams</h1>

    <div class="d-flex flex-column gap-3">
        <div class="d-flex align-items-center justify-content-between">
            <Heading
                variant="small"
                title="Teams"
                description="Manage your teams and team memberships"
            />

            <CreateTeamModal v-slot="{ showModal }">
                <Button data-test="teams-new-team-button" @click="showModal">
                    <CIcon class="nav-icon" :icon="cilPlus" />
                    New team
                </Button>
            </CreateTeamModal>
        </div>

        <ListGroup class="rounded-4 shadow-sm">
            <ListGroupItem
                v-for="team in teams"
                :key="team.id"
                data-test="team-row"
                class="d-flex align-items-center justify-content-between"
            >
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-medium">{{ team.name }}</span>
                        <Badge v-if="team.isPersonal" color="secondary">
                            Personal
                        </Badge>
                    </div>
                    <span class="small text-muted">
                        {{ team.roleLabel }}
                    </span>
                </div>

                <Tooltip
                    v-if="team.role === 'member'"
                    v-slot="{ id, on }"
                    class="nav-link icon-link"
                    content="View team"
                    placement="top"
                >
                    <TextLink
                        v-on="on"
                        :href="edit(team.slug)"
                        :aria-describedby="id"
                    >
                        <span class="visually-hidden">View team</span>
                        <CIconSvg>
                            <biEye />
                        </CIconSvg>
                    </TextLink>
                </Tooltip>
                <Tooltip
                    v-else
                    v-slot="{ id, on }"
                    content="Edit team"
                    placement="top"
                >
                    <TextLink
                        v-on="on"
                        :href="edit(team.slug)"
                        :aria-describedby="id"
                    >
                        <span class="visually-hidden">Edit team</span>
                        <CIcon :icon="cilPencil" />
                    </TextLink>
                </Tooltip>
            </ListGroupItem>
        </ListGroup>

        <p v-if="teams.length === 0" class="text-muted text-center">
            You don't belong to any teams yet.
        </p>
    </div>
</template>
