<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppearanceSwitcher from '@/components/AppearanceSwitcher.vue';
import AppLogo from '@/components/AppLogo.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import TeamSwitcher from '@/components/TeamSwitcher.vue';
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
    NavigationMenuList,
    NavigationMenuTrigger,
} from '@/components/ui/navigation-menu';
import { Tooltip } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { getInitials } from '@/composables/useInitials';
import { cibGit, cilApplications, cilFlip } from '@/icons';
import { dashboard, home } from '@/routes';
import type { BreadcrumbItem, NavItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const auth = computed(() => page.props.auth);
const isVisible = ref(false);
const { isCurrentUrl } = useCurrentUrl();

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

const rightNavItems: NavItem[] = [
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
    <div class="shadow-sm">
        <NavigationMenu class="bg-body border-bottom" container expand="md">
            <AppLogo :href="home()" :alt="page.props.name" />
            <NavigationMenuTrigger
                :aria-expanded="isVisible"
                aria-label="Toggle navigation"
                @click="isVisible = !isVisible"
            />
            <NavigationMenuContent :visible="isVisible">
                <!-- Left Side Of Navbar -->
                <NavigationMenuList class="me-auto">
                    <template v-for="item in mainNavItems" :key="item.title">
                        <NavigationMenuItem
                            v-if="item.isActive ?? true"
                            class="icon-link"
                            :href="item.href"
                            link-as="Link"
                            :active="isCurrentUrl(item.href)"
                        >
                            <CIcon
                                v-if="item.icon"
                                class="nav-icon"
                                :icon="item.icon"
                            />
                            {{ item.title }}
                        </NavigationMenuItem>
                    </template>
                </NavigationMenuList>

                <!-- Right Side Of Navbar -->
                <NavigationMenuList class="align-items-md-center ms-auto">
                    <template v-for="item in rightNavItems" :key="item.title">
                        <Tooltip
                            v-slot="{ id, on }"
                            :content="item.title"
                            placement="bottom"
                        >
                            <NavigationMenuItem
                                v-on="on"
                                class="pb-md-0"
                                :href="item.href"
                                target="_blank"
                                rel="noopener noreferrer"
                                :aria-describedby="id"
                            >
                                <span class="visually-hidden">
                                    {{ item.title }}
                                </span>
                                <CIcon
                                    v-if="item.icon"
                                    class="nav-icon"
                                    :icon="item.icon"
                                    size="xl"
                                />
                            </NavigationMenuItem>
                        </Tooltip>
                    </template>

                    <AppearanceSwitcher />

                    <!-- Authentication Links -->
                    <DropdownMenu
                        v-if="auth.user"
                        :alignment="{ md: 'end' }"
                        variant="nav-item"
                    >
                        <DropdownMenuTrigger class="nav-link" :caret="false">
                            <AvatarImage
                                v-if="auth.user.avatar"
                                :src="auth.user.avatar"
                                :alt="auth.user.name"
                                status="success"
                            />
                            <AvatarFallback v-else status="success">
                                {{ getInitials(auth.user.name) }}
                            </AvatarFallback>
                        </DropdownMenuTrigger>

                        <DropdownMenuContent class="rounded-4 min-w-50">
                            <UserMenuContent :user="auth.user" />
                        </DropdownMenuContent>
                    </DropdownMenu>
                    <TeamSwitcher :in-header="true" />
                </NavigationMenuList>
            </NavigationMenuContent>
        </NavigationMenu>

        <!-- Breadcrumbs -->
        <NavigationMenu
            v-if="breadcrumbs && breadcrumbs.length > 0"
            class="bg-body"
            container
        >
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </NavigationMenu>
    </div>
</template>
