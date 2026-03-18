<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import Icon from '@/components/Icon.vue';
import {
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { SidebarMenuLink } from '@/components/ui/sidebar';
import UserInfo from '@/components/UserInfo.vue';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { AppVariant, User } from '@/types';

type Props = {
    user: User;
    variant?: AppVariant;
};

const handleLogout = () => {
    router.flushAll();
};

withDefaults(defineProps<Props>(), {
    variant: 'header',
});
</script>

<template>
    <template v-if="variant === 'header'">
        <DropdownMenuLabel class="py-0 px-2">
            <div class="d-flex align-items-center gap-2 p-1 text-start">
                <UserInfo :user="user" :show-email="true" />
            </div>
        </DropdownMenuLabel>
        <DropdownMenuSeparator />
        <DropdownMenuItem :href="edit()" class="icon-link" prefetch>
            <Icon name="gear" />
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
            <Icon name="box-arrow-right" />
            Log out
        </DropdownMenuItem>
    </template>
    <template v-else>
        <SidebarMenuLink :href="edit()" prefetch>
            <Icon class="nav-icon" name="gear" />
            Settings
        </SidebarMenuLink>
        <SidebarMenuLink
            class="w-100"
            as="button"
            :href="logout()"
            @click="handleLogout"
            data-test="logout-button"
        >
            <Icon class="nav-icon" name="box-arrow-right" />
            Log out
        </SidebarMenuLink>
    </template>
</template>
