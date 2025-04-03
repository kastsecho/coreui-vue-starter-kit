<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import { useSidebarStore } from '@/composables/useSidebarStore';
import type { Auth, BreadcrumbItem, NavItem, SharedData } from '@/types';
import { CAvatar, CContainer, CDropdown, CDropdownMenu, CDropdownToggle, CHeader, CHeaderNav, CHeaderToggler, CNavItem } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage<SharedData>();
const auth = computed(() => page.props.auth as Auth);

const headerClassNames = ref<string | null>(null);
const sidebar = useSidebarStore();

const isCurrentRoute = computed(() => (url: string) => page.url === url);

const activeItemStyles = computed(() => (url: string) => (isCurrentRoute.value(url) ? 'active' : ''));

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: 'bi-grid',
    },
];

onMounted(() => {
    document.addEventListener('scroll', () => {
        headerClassNames.value = document.documentElement.scrollTop > 0 ? 'shadow-sm' : null;
    });
});
</script>

<template>
    <CHeader position="sticky" class="mb-4 p-0" :class="headerClassNames">
        <CContainer class="border-bottom px-4" fluid>
            <!-- Hamburger -->
            <CHeaderToggler @click="sidebar.toggleVisible()" style="margin-inline-start: -14px">
                <span class="icon icon-lg bi-list" />
            </CHeaderToggler>

            <!-- Navigation Links -->
            <CHeaderNav class="d-none d-md-flex">
                <CNavItem v-for="item in mainNavItems" :key="item.title">
                    <Link :href="item.href" class="nav-link" :class="activeItemStyles(item.href)">
                        <span class="icon icon-lg" :class="item.icon" />
                        <span class="ms-2">{{ item.title }}</span>
                    </Link>
                </CNavItem>
            </CHeaderNav>

            <CHeaderNav class="ms-auto">
                <CNavItem>
                    <Link class="nav-link" href="#">
                        <span class="icon icon-lg bi-bell" />
                    </Link>
                </CNavItem>
                <CNavItem>
                    <Link class="nav-link" href="#">
                        <span class="icon icon-lg bi-list-check" />
                    </Link>
                </CNavItem>
                <CNavItem>
                    <Link class="nav-link" href="#">
                        <span class="icon icon-lg bi-envelope-open" />
                    </Link>
                </CNavItem>
            </CHeaderNav>

            <CHeaderNav>
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
                            <CAvatar v-if="!auth.user.avatar" color="secondary" shape="rounded-circle" status="success" text-color="white">
                                {{ getInitials(auth.user.name) }}
                            </CAvatar>
                            <CAvatar v-else shape="rounded-circle" status="success" :src="auth.user.avatar" :alt="auth.user.name" />
                        </CDropdownToggle>

                        <CDropdownMenu class="min-w-50">
                            <UserMenuContent :user="auth.user" />
                        </CDropdownMenu>
                    </CDropdown>
                </template>
            </CHeaderNav>
        </CContainer>

        <!-- Page Heading -->
        <CContainer v-if="breadcrumbs.length" fluid class="px-4 py-2">
            <Breadcrumbs :breadcrumbs />
        </CContainer>
    </CHeader>
</template>
