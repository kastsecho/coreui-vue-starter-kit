<script setup lang="ts">
import { cilCheck, cilPeople, cilPlus } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import CreateTeamModal from '@/components/CreateTeamModal.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { SidebarGroup, SidebarMenuItem } from '@/components/ui/sidebar';
import { switchMethod } from '@/routes/teams';
import type { Team } from '@/types';

type Props = {
    inHeader?: boolean;
};

withDefaults(defineProps<Props>(), {
    inHeader: false,
});

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
    <CreateTeamModal v-if="inHeader" v-slot="{ showModal }">
        <DropdownMenu alignment="end" variant="nav-item" teleport>
            <DropdownMenuTrigger class="nav-link">
                {{ currentTeam?.name ?? 'Select team' }}
            </DropdownMenuTrigger>
            <DropdownMenuContent class="rounded-4 min-w-50 overflow-x-hidden">
                <DropdownMenuLabel class="px-2 py-0">
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
                    <CIcon
                        v-if="currentTeam?.id === team.id"
                        class="nav-icon ms-auto"
                        :icon="cilCheck"
                    />
                </DropdownMenuItem>
                <DropdownMenuSeparator />
                    <DropdownMenuItem
                        data-test="team-switcher-new-team"
                        class="icon-link"
                        @click="showModal"
                    >
                        <CIcon class="nav-icon" :icon="cilPlus" />
                        New team
                    </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    </CreateTeamModal>
    <SidebarGroup v-else>
        <template #togglerContent>
            <CIcon class="nav-icon" :icon="cilPeople" />
            {{ currentTeam?.name ?? 'Select team' }}
        </template>
        <SidebarMenuItem
            v-for="team in teams"
            :key="team.id"
            href="#"
            data-test="team-switcher-item"
            :active="currentTeam?.id === team.id"
            @click="switchTeam(team)"
        >
            <span class="nav-icon">
                <span class="nav-icon-bullet"></span>
            </span>
            {{ team.name }}
            <CIcon
                v-if="currentTeam?.id === team.id"
                class="text-success ms-auto"
                :icon="cilCheck"
            />
        </SidebarMenuItem>
        <CreateTeamModal v-slot="{ showModal }">
            <SidebarMenuItem
                href="#"
                data-test="team-switcher-new-team"
                @click="showModal"
            >
                <CIcon class="nav-icon" :icon="cilPlus" />
                New team
            </SidebarMenuItem>
        </CreateTeamModal>
    </SidebarGroup>
</template>
