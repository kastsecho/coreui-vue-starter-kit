<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import simplebar from 'simplebar-vue';
import { computed, markRaw } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import TeamSwitcher from '@/components/TeamSwitcher.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenuButton,
    SidebarRail,
} from '@/components/ui/sidebar';
import { cilApplications, cilFlip, cibGit } from '@/icons';
import { dashboard, home } from '@/routes';
import type { NavItem } from '@/types';

const simplebarRef = markRaw(simplebar);

const page = usePage();
const isOpen = computed(() => page.props.sidebarOpen);

const dashboardUrl = computed(() =>
    page.props.currentTeam ? dashboard(page.props.currentTeam.slug).url : '/',
);

const mainNavItems = computed<NavItem[]>(() => [
    {
        title: 'Dashboard',
        href: dashboardUrl.value,
        icon: cilApplications,
    },
]);

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/kastsecho/coreui-vue-starter-kit',
        icon: cibGit,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: cilFlip,
    },
];
</script>

<template>
    <Sidebar color-scheme="dark" :open="isOpen">
        <SidebarHeader>
            <Link class="sidebar-brand link-danger" :href="home()">
                <AppLogoIcon
                    class="sidebar-brand-full"
                    height="32"
                    width="32"
                />
                <AppLogoIcon
                    class="sidebar-brand-narrow"
                    height="32"
                    width="32"
                />
            </Link>
            <SidebarMenuButton class="d-lg-none" dark />
            <SidebarRail class="d-sidebar-narrow-none" />
        </SidebarHeader>

        <SidebarContent :as="simplebarRef">
            <TeamSwitcher />
            <NavMain :items="mainNavItems" />
            <NavFooter class="mt-auto" :items="footerNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
