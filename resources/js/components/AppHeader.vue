<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import type { Auth, BreadcrumbItem, NavItem, SharedData } from '@/types';
import {
    CAvatar,
    CCollapse,
    CContainer,
    CDropdown,
    CDropdownMenu,
    CDropdownToggle,
    CNavbar,
    CNavbarNav,
    CNavbarToggler,
    CNavItem,
    CNavLink,
} from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage<SharedData>();
const auth = computed(() => page.props.auth as Auth);

const visible = ref<boolean>(false);

const isCurrentRoute = computed(() => (url: string) => page.url === url);

const activeItemStyles = computed(() => (url: string) => (isCurrentRoute.value(url) ? 'active' : ''));

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: 'bi-grid',
    },
];

const rightNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/kastsecho/coreui-vue-starter-kit',
        icon: 'bi-folder',
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits',
        icon: 'bi-book',
    },
];
</script>

<template>
    <header class="bg-body" :class="{ 'shadow-sm': breadcrumbs.length }">
        <CNavbar expand="md" :class="{ 'shadow-sm': !breadcrumbs.length, 'border-bottom': breadcrumbs.length }">
            <!-- Primary Navigation Menu -->
            <CContainer>
                <!-- Logo -->
                <Link class="navbar-brand" :href="route('home')">
                    <AppLogoIcon class="size-8 link-danger" />
                    <span class="visually-hidden">{{ page.props.name }}</span>
                </Link>

                <!-- Hamburger -->
                <CNavbarToggler type="button" @click="visible = !visible" aria-label="Toggle navbar" />

                <!-- Navigation Links -->
                <CCollapse class="navbar-collapse" :visible>
                    <CNavbarNav class="me-auto">
                        <CNavItem v-if="auth.user">
                            <Link class="nav-link icon-link" :href="mainNavItems[0].href">
                                <span :class="mainNavItems[0].icon" />
                                <span>{{ mainNavItems[0].title }}</span>
                            </Link>
                        </CNavItem>

                        <CNavItem v-for="item in mainNavItems.splice(1)" :key="item.title">
                            <Link :href="item.href" class="nav-link icon-link" :class="activeItemStyles(item.href)">
                                <span :class="item.icon" />
                                <span>{{ item.title }}</span>
                            </Link>
                        </CNavItem>
                    </CNavbarNav>

                    <CNavbarNav class="ms-auto d-flex align-items-center">
                        <CNavItem v-for="item in rightNavItems" :key="item.title">
                            <CNavLink :href="item.href" target="_blank" rel="noopener noreferrer" class="nav-link icon-link">
                                <span :class="item.icon" />
                                <span>{{ item.title }}</span>
                            </CNavLink>
                        </CNavItem>

                        <template v-if="!auth.user">
                            <CNavItem>
                                <Link class="nav-link" :href="route('login')">Log in</Link>
                            </CNavItem>

                            <CNavItem>
                                <Link class="nav-link" :href="route('register')">Register</Link>
                            </CNavItem>
                        </template>

                        <template v-else>
                            <!-- Settings Dropdown -->
                            <CDropdown alignment="end" variant="nav-item">
                                <CDropdownToggle :caret="false">
                                    <CAvatar v-if="!auth.user.avatar" color="secondary" text-color="white" shape="rounded-circle" status="success">
                                        {{ getInitials(auth.user.name) }}
                                    </CAvatar>
                                    <CAvatar v-else shape="rounded-circle" status="success" :src="auth.user.avatar" :alt="auth.user.name" />
                                </CDropdownToggle>

                                <CDropdownMenu class="min-w-50">
                                    <UserMenuContent :user="auth.user" />
                                </CDropdownMenu>
                            </CDropdown>
                        </template>
                    </CNavbarNav>
                </CCollapse>
            </CContainer>
        </CNavbar>

        <!-- Page Heading -->
        <CNavbar v-if="breadcrumbs.length" class="py-2">
            <CContainer>
                <Breadcrumbs :breadcrumbs />
            </CContainer>
        </CNavbar>
    </header>
</template>
