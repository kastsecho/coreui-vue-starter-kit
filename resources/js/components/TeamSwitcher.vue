<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import CreateTeamModal from '@/components/CreateTeamModal.vue';
import Icon from '@/components/Icon.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { SidebarGroup, SidebarMenuLink } from '@/components/ui/sidebar';
import { switchMethod } from '@/routes/teams';
import type { Team } from '@/types';

withDefaults(
    defineProps<{
        inHeader?: boolean;
    }>(),
    {
        inHeader: false,
    },
);

const page = usePage();

const currentTeam = computed(() => page.props.currentTeam);
const teams = computed(() => page.props.teams ?? []);

const switchTeam = (team: Team) => {
    const previousTeamSlug = currentTeam.value?.slug;

    router.visit(switchMethod(team.slug), {
        onFinish: () => {
            if (!previousTeamSlug || typeof window === 'undefined') {
                router.reload();

                return;
            }

            const currentUrl = `${window.location.pathname}${window.location.search}${window.location.hash}`;
            const segment = `/${previousTeamSlug}`;

            if (currentUrl.includes(segment)) {
                router.visit(currentUrl.replace(segment, `/${team.slug}`), {
                    replace: true,
                });

                return;
            }

            router.reload();
        },
    });
};
</script>

<template>
    <DropdownMenu v-if="inHeader" align="end" variant="nav-item" teleport>
        <DropdownMenuTrigger class="nav-link">
            {{ currentTeam?.name ?? 'Select team' }}
        </DropdownMenuTrigger>
        <DropdownMenuContent class="min-w-50">
            <DropdownMenuLabel class="py-0 px-2">
                <div class="d-flex align-items-center gap-2 p-1 text-start">
                    Teams
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem
                v-for="team in teams"
                :key="team.id"
                data-test="team-switcher-item"
                class="icon-link"
                :active="currentTeam?.id === team.id"
                @click="switchTeam(team)"
            >
                {{ team.name }}
                <Icon
                    v-if="currentTeam?.id === team.id"
                    class="ms-auto nav-icon"
                    name="check"
                />
            </DropdownMenuItem>
            <DropdownMenuSeparator />
            <CreateTeamModal>
                <DropdownMenuItem
                    data-test="team-switcher-new-team"
                    class="icon-link"
                    @select.prevent
                >
                    <Icon class="nav-icon" name="plus" />
                    New team
                </DropdownMenuItem>
            </CreateTeamModal>
        </DropdownMenuContent>
    </DropdownMenu>
    <SidebarGroup v-else>
        <template #togglerContent>
            <Icon class="nav-icon" name="people" />
            {{ currentTeam?.name ?? 'Select team' }}
        </template>
        <SidebarMenuLink
            v-for="team in teams"
            :key="team.id"
            data-test="team-switcher-item"
            :active="currentTeam?.id === team.id"
            @click="switchTeam(team)"
        >
            <span class="nav-icon">
                <span class="nav-icon-bullet"></span>
            </span>
            {{ team.name }}
            <Icon
                v-if="currentTeam?.id === team.id"
                class="ms-auto"
                name="check"
            />
        </SidebarMenuLink>
        <CreateTeamModal>
            <SidebarMenuLink data-test="team-switcher-new-team" @select.prevent>
                <Icon class="nav-icon" name="plus" />
                New team
            </SidebarMenuLink>
        </CreateTeamModal>
    </SidebarGroup>
</template>
