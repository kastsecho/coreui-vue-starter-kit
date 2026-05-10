<script setup lang="ts">
import { cilAccountLogout, cilCog } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { router } from '@inertiajs/vue3';
import {
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { SidebarMenuItem } from '@/components/ui/sidebar';
import UserInfo from '@/components/UserInfo.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { AppVariant, User } from '@/types';

type Props = {
    user: User;
    variant?: AppVariant;
};

withDefaults(defineProps<Props>(), {
    variant: 'header',
});

const { isCurrentOrParentUrl } = useCurrentUrl();

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <template v-if="variant === 'header'">
        <DropdownMenuLabel class="px-2 py-0">
            <div class="d-flex align-items-center gap-2 p-1 text-start">
                <UserInfo :user="user" :show-email="true" />
            </div>
        </DropdownMenuLabel>
        <DropdownMenuSeparator />
        <DropdownMenuItem
            class="icon-link"
            :href="edit()"
            :active="isCurrentOrParentUrl('/settings')"
            prefetch
        >
            <CIcon class="nav-icon me-2" :icon="cilCog" />
            Settings
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem
            class="icon-link"
            :href="logout()"
            @click="handleLogout"
            as="button"
            data-test="logout-button"
        >
            <CIcon class="nav-icon me-2" :icon="cilAccountLogout" />
            Log out
        </DropdownMenuItem>
    </template>
    <template v-else>
        <SidebarMenuItem
            :href="edit()"
            :active="isCurrentOrParentUrl('/settings')"
            prefetch
        >
            <CIcon custom-class-name="nav-icon" :icon="cilCog" />
            Settings
        </SidebarMenuItem>
        <SidebarMenuItem
            :href="logout()"
            @click="handleLogout"
            data-test="logout-button"
        >
            <CIcon custom-class-name="nav-icon" :icon="cilAccountLogout" />
            Log out
        </SidebarMenuItem>
    </template>
</template>
