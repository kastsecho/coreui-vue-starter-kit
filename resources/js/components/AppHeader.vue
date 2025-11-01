<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import Icon from '@/components/Icon.vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
} from '@/components/ui/navigation-menu';
import { Tooltip } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import { urlIsActive } from '@/lib/utils';
import { dashboard, home } from '@/routes';
import type { BreadcrumbItem, NavItem } from '@/types';
import { type InertiaLinkProps, Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const auth = computed(() => page.props.auth);

const navVisible = ref(false);

const isCurrentRoute = computed(
    () => (url: NonNullable<InertiaLinkProps['href']>) =>
        urlIsActive(url, page.url),
);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: 'grid',
        isActive: !!auth.value.user,
    },
];

const rightNavItems: NavItem[] = [
    {
        title: 'Repository',
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
    <div class="shadow-sm">
        <!-- Desktop Menu -->
        <NavigationMenu class="bg-body border-bottom" container expand="md">
            <Link class="navbar-brand link-danger" :href="home()">
                <AppLogoIcon height="32" width="32" />
            </Link>
            <NavigationMenuTrigger @click="navVisible = !navVisible" />

            <NavigationMenuContent :visible="navVisible">
                <NavigationMenuList class="me-auto">
                    <template
                        v-for="(item, index) in mainNavItems"
                        :key="index"
                    >
                        <NavigationMenuItem v-if="item.isActive ?? true">
                            <NavigationMenuLink
                                class="icon-link"
                                :href="item.href"
                                :active="isCurrentRoute(item.href)"
                            >
                                <Icon
                                    v-if="item.icon"
                                    class="me-2"
                                    :name="item.icon"
                                />
                                {{ item.title }}
                            </NavigationMenuLink>
                        </NavigationMenuItem>
                    </template>
                </NavigationMenuList>
                <NavigationMenuList class="ms-auto align-items-center">
                    <NavigationMenuItem
                        v-for="item in rightNavItems"
                        :key="item.title"
                    >
                        <Tooltip
                            class="nav-link icon-link"
                            :content="item.title"
                            v-slot="{ id, on }"
                            placement="bottom"
                        >
                            <NavigationMenuLink
                                v-on="on"
                                as="a"
                                :href="item.href"
                                target="_blank"
                                rel="noopener noreferrer"
                                :aria-describedby="id"
                            >
                                <span class="visually-hidden">
                                    {{ item.title }}
                                </span>
                                <Icon v-if="item.icon" :name="item.icon" />
                            </NavigationMenuLink>
                        </Tooltip>
                    </NavigationMenuItem>

                    <NavigationMenuItem>
                        <NavigationMenuLink class="icon-link" href="#">
                            <Icon name="search" />
                        </NavigationMenuLink>
                    </NavigationMenuItem>

                    <DropdownMenu
                        v-if="auth.user"
                        align="end"
                        variant="nav-item"
                        teleport
                    >
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
                </NavigationMenuList>
            </NavigationMenuContent>
        </NavigationMenu>
        <NavigationMenu
            v-if="breadcrumbs.length >= 1"
            class="bg-body"
            container
        >
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </NavigationMenu>
    </div>
</template>
