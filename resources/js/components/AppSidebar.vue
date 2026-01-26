<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import simplebar from 'simplebar-vue';
import { computed } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarMenuButton,
    SidebarMenuHeader,
    SidebarRail,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import { type NavItem } from '@/types';

const page = usePage();
const auth = computed(() => page.props.auth);
const isOpen = page.props.sidebarOpen;

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: 'grid',
        isActive: !!auth.value.user,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/kastsecho/coreui-vue-starter-kit',
        icon: 'folder',
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: 'book',
    },
];
</script>

<template>
    <Sidebar :open="isOpen">
        <SidebarMenuHeader>
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
        </SidebarMenuHeader>

        <SidebarContent :as="simplebar">
            <NavMain :items="mainNavItems" />
            <NavUser />
            <NavFooter class="mt-auto" :items="footerNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <SidebarRail />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
