<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import Icon from '@/components/Icon.vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import {
    NavigationMenuItem,
    NavigationMenuLink,
} from '@/components/ui/navigation-menu';
import {
    SidebarHeader,
    SidebarHeaderList,
    SidebarRail,
    useSidebar
} from '@/components/ui/sidebar';
import { Tooltip } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import { cn, urlIsActive } from '@/lib/utils';
import { dashboard, login, register } from '@/routes';
import type { BreadcrumbItem, NavItem } from '@/types';
import { CContainer } from '@coreui/vue';
import { type InertiaLinkProps, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(),{
    breadcrumbs: () => [],
});

const page = usePage();
const auth = computed(() => page.props.auth);
const sidebar = useSidebar();

const headerClassNames = ref<string | null>(null);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: 'grid',
    },
];

const rightNavItems: NavItem[] = [
    {
        title: 'Notifications',
        href: '#',
        icon: 'bell',
    },
    {
        title: 'Tasks',
        href: '#',
        icon: 'list-check',
    },
    {
        title: 'Messages',
        href: '#',
        icon: 'envelope-open',
    },
];

const isCurrentRoute = computed(
    () => (url: NonNullable<InertiaLinkProps['href']>) =>
        urlIsActive(url, page.url),
);

onMounted(() => {
    document.addEventListener('scroll', () => {
        headerClassNames.value = document.documentElement.scrollTop > 0 ? 'shadow-sm' : null;
    });

    sidebar.setOpen(usePage().props.sidebarOpen);
});
</script>

<template>
    <SidebarHeader
        :class="cn('mb-4 p-0', headerClassNames)"
        position="sticky"
    >
        <CContainer class="border-bottom px-4" fluid>
            <!-- Hamburger -->
            <SidebarRail @click="sidebar.toggleOpen()" style="margin-inline-start: -14px">
                <Icon class="icon icon-lg" name="list" />
            </SidebarRail>

            <!-- Navigation Links -->
            <SidebarHeaderList class="d-none d-md-flex">
                <template
                    v-for="(item, index) in mainNavItems"
                    :key="index"
                >
                    <NavigationMenuItem v-if="item.isActive ?? true">
                        <NavigationMenuLink
                            :href="item.href"
                            :active="isCurrentRoute(item.href)"
                        >
                            <Icon
                                v-if="item.icon"
                                class="me-2 icon icon-lg"
                                :name="item.icon"
                            />
                            {{ item.title }}
                        </NavigationMenuLink>
                    </NavigationMenuItem>
                </template>
            </SidebarHeaderList>

            <SidebarHeaderList class="ms-auto align-items-center">
                <NavigationMenuItem
                    v-for="item in rightNavItems"
                    :key="item.title"
                >
                    <Tooltip
                        :content="item.title"
                        v-slot="{ id, on }"
                        placement="bottom"
                    >
                        <NavigationMenuLink
                            v-on="on"
                            :href="item.href"
                            :aria-describedby="id"
                        >
                            <span class="visually-hidden">
                                {{ item.title }}
                            </span>
                            <Icon
                                v-if="item.icon"
                                class="icon icon-lg"
                                :name="item.icon"
                            />
                        </NavigationMenuLink>
                    </Tooltip>
                </NavigationMenuItem>

                <NavigationMenuItem>
                    <NavigationMenuLink href="#">
                        <Icon class="icon icon-lg" name="search" />
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </SidebarHeaderList>

            <SidebarHeaderList>
                <!-- Settings Dropdown -->
                <DropdownMenu v-if="auth.user" align="end" variant="nav-item">
                    <DropdownMenuTrigger class="nav-link" :caret="false">
                        <AvatarImage
                            v-if="auth.user.avatar"
                            :src="auth.user.avatar"
                            :alt="auth.user.name"
                            status="success"
                        />
                        <AvatarFallback
                            v-else
                            class="fw-semibold"
                            status="success"
                        >
                            {{ getInitials(auth.user?.name) }}
                        </AvatarFallback>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent class="min-w-50">
                        <UserMenuContent :user="auth.user" />
                    </DropdownMenuContent>
                </DropdownMenu>

                <template v-else>
                    <NavigationMenuItem>
                        <NavigationMenuItem :href="login()">
                            Log in
                        </NavigationMenuItem>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                        <NavigationMenuItem :href="register()">
                            Register
                        </NavigationMenuItem>
                    </NavigationMenuItem>
                </template>
            </SidebarHeaderList>
        </CContainer>

        <!-- Page Heading -->
        <CContainer
            v-if="breadcrumbs && breadcrumbs.length >= 1"
            class="px-4 py-2"
            fluid
        >
            <Breadcrumbs :breadcrumbs />
        </CContainer>
    </SidebarHeader>
</template>
