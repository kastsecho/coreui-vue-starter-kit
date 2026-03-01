<script setup lang="ts">
import { CContainer } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import AppearanceDropdown from '@/components/AppearanceDropdown.vue';
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
    SidebarTrigger,
} from '@/components/ui/sidebar';
import { Tooltip } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { getInitials } from '@/composables/useInitials';
import { cn } from '@/lib/utils';
import { dashboard } from '@/routes';
import type { AppBreadcrumbProps, NavItem } from '@/types';

const page = usePage();
const auth = computed(() => page.props.auth);
const { isCurrentOrParentUrl } = useCurrentUrl();

withDefaults(defineProps<AppBreadcrumbProps>(), {
    breadcrumbs: () => [],
});

const headerClassNames = ref<string | null>(null);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        isActive: !!auth.value.user,
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

onMounted(() => {
    document.addEventListener('scroll', () => {
        headerClassNames.value =
            document.documentElement.scrollTop > 0 ? 'shadow-sm' : null;
    });
});
</script>

<template>
    <SidebarHeader :class="cn('mb-4 p-0', headerClassNames)" position="sticky">
        <CContainer class="border-bottom px-4" fluid>
            <!-- Hamburger -->
            <SidebarTrigger style="margin-inline-start: -14px" />

            <!-- Navigation Links -->
            <SidebarHeaderList class="d-none d-md-flex">
                <template v-for="item in mainNavItems" :key="item.title">
                    <NavigationMenuItem v-if="item.isActive ?? true">
                        <NavigationMenuLink
                            class="icon-link"
                            :href="item.href"
                            :active="isCurrentOrParentUrl(item.href)"
                        >
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
            </SidebarHeaderList>

            <SidebarHeaderList class="align-items-center">
                <AppearanceDropdown icon-class="icon icon-lg" />
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
                            {{ getInitials(auth.user.name) }}
                        </AvatarFallback>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent class="min-w-50">
                        <UserMenuContent :user="auth.user" />
                    </DropdownMenuContent>
                </DropdownMenu>
            </SidebarHeaderList>
        </CContainer>

        <CContainer
            v-if="breadcrumbs && breadcrumbs.length >= 1"
            class="px-4 py-2"
            fluid
        >
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </CContainer>
    </SidebarHeader>
</template>
