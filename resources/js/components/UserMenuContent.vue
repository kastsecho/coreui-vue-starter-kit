<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { router } from '@inertiajs/vue3';
import {
    DropdownMenuItem,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import UserInfo from '@/components/UserInfo.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { cilAccountLogout, cilCog } from '@/icons';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';

defineProps<{
    user: User;
}>();

const { isCurrentOrParentUrl } = useCurrentUrl();

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <div class="d-flex gap-2 px-2">
        <UserInfo :user="user" :show-email="true" />
    </div>
    <DropdownMenuSeparator />
    <DropdownMenuItem
        class="d-flex align-items-center gap-2"
        :href="edit()"
        :active="isCurrentOrParentUrl('/settings')"
        prefetch
    >
        <CIcon :icon="cilCog" />
        Settings
    </DropdownMenuItem>
    <DropdownMenuSeparator />
    <DropdownMenuItem
        class="d-flex align-items-center gap-2"
        :href="logout()"
        @click="handleLogout"
        as="button"
        data-test="logout-button"
    >
        <CIcon :icon="cilAccountLogout" />
        Log out
    </DropdownMenuItem>
</template>
