<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { useSidebar } from '@/components/ui/sidebar/utils';
import type { NavItem, SharedData } from '@/types';
import { CCloseButton, CSidebar, CSidebarFooter, CSidebarHeader, CSidebarNav, CSidebarToggler } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';
import simplebar from 'simplebar-vue';
import { onMounted } from 'vue';

const sidebar = useSidebar();

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: 'bi-grid',
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/kastsecho/coreui-vue-starter-kit',
        icon: 'bi-folder',
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits',
        icon: 'bi-book',
    },
];

onMounted(() => {
    sidebar.setOpen(usePage<SharedData>().props.sidebarOpen);
});
</script>

<template>
    <CSidebar
        class="border-end"
        colorScheme="dark"
        position="fixed"
        :unfoldable="sidebar.openMobile"
        :visible="sidebar.open"
        @visible-change="(value) => sidebar.setOpen(value)"
    >
        <CSidebarHeader class="border-bottom">
            <Link class="sidebar-brand link-danger" :href="route('home')">
                <AppLogoIcon class="sidebar-brand-full" width="32" />
                <AppLogoIcon class="sidebar-brand-narrow" width="32" />
            </Link>
            <CCloseButton class="d-lg-none" dark @click="sidebar.toggleOpen()" />
        </CSidebarHeader>

        <CSidebarNav :as="simplebar">
            <NavMain :items="mainNavItems" />
            <NavUser />
            <NavFooter :items="footerNavItems" />
        </CSidebarNav>

        <CSidebarFooter class="border-top d-none d-lg-flex">
            <CSidebarToggler @click="sidebar.toggleOpenMobile()" />
        </CSidebarFooter>
    </CSidebar>
</template>
