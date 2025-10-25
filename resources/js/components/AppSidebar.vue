<script setup lang="ts">
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
    SidebarTrigger,
    useSidebar,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import type { NavItem } from '@/types';
import { usePage, Link } from '@inertiajs/vue3';
import simplebar from 'simplebar-vue';
import { computed } from 'vue';

const page = usePage();
const auth = computed(() => page.props.auth);
const sidebar = useSidebar();

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
    <Sidebar>
        <SidebarMenuHeader>
            <Link class="sidebar-brand link-danger" :href="home()">
                <AppLogoIcon class="sidebar-brand-full" height="32" width="32" />
                <AppLogoIcon class="sidebar-brand-narrow" height="32" width="32" />
            </Link>
            <SidebarMenuButton class="d-lg-none" dark @click="sidebar.toggleOpen()" />
        </SidebarMenuHeader>

        <SidebarContent :as="simplebar">
            <NavMain :items="mainNavItems" />
            <NavUser />
            <NavFooter :items="footerNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <SidebarTrigger @click="sidebar.toggleOpenMobile()" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
