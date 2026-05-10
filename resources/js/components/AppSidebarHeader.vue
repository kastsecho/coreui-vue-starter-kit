<script setup lang="ts">
import { cilApplications } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import AppearanceSwitcher from '@/components/AppearanceSwitcher.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { NavigationMenuItem } from '@/components/ui/navigation-menu';
import {
    SidebarMenuHeader,
    SidebarMenuHeaderList,
    SidebarTrigger,
} from '@/components/ui/sidebar';
import { Container } from '@/components/ui/skeleton';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { getInitials } from '@/composables/useInitials';
import { cn } from '@/lib/utils';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, NavItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const auth = computed(() => page.props.auth);
const { isCurrentOrParentUrl } = useCurrentUrl();

const headerClassNames = ref<string | null>(null);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: cilApplications,
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
    <SidebarMenuHeader
        :class="cn('mb-4 p-0', headerClassNames)"
        position="sticky"
    >
        <Container class="border-bottom px-4" fluid>
            <!-- Hamburger -->
            <SidebarTrigger style="margin-inline-start: -14px" />

            <!-- Navigation Links -->
            <SidebarMenuHeaderList class="d-none d-md-flex">
                <template v-for="item in mainNavItems" :key="item.title">
                    <NavigationMenuItem
                        v-if="item.isActive ?? true"
                        class="icon-link"
                        :href="item.href"
                        link-as="Link"
                        :active="isCurrentOrParentUrl(item.href)"
                    >
                        <CIcon
                            v-if="item.icon"
                            class="nav-icon"
                            :icon="item.icon"
                        />
                        {{ item.title }}
                    </NavigationMenuItem>
                </template>
            </SidebarMenuHeaderList>

            <SidebarMenuHeaderList class="align-items-center ms-auto">
                <AppearanceSwitcher icon-class="icon icon-lg" />
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
                        <AvatarFallback
                            v-else
                            class="fw-semibold"
                            status="success"
                        >
                            {{ getInitials(auth.user.name) }}
                        </AvatarFallback>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent class="rounded-4 min-w-50">
                        <UserMenuContent :user="auth.user" />
                    </DropdownMenuContent>
                </DropdownMenu>
            </SidebarMenuHeaderList>
        </Container>

        <Container
            v-if="breadcrumbs && breadcrumbs.length >= 1"
            class="px-4 py-2"
            fluid
        >
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </Container>
    </SidebarMenuHeader>
</template>
