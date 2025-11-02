<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import UserInfo from '@/components/UserInfo.vue';
import {
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { NavigationMenuLink } from '@/components/ui/navigation-menu';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';
import { router } from '@inertiajs/vue3';

interface Props {
    user: User;
    variant?: 'header' | 'sidebar';
}

withDefaults(defineProps<Props>(), {
    variant: 'header',
});

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <template v-if="variant === 'sidebar'">
        <NavigationMenuLink class="w-100" as="button" :href="edit()" prefetch>
            <Icon class="nav-icon" name="gear" />
            Settings
        </NavigationMenuLink>
        <NavigationMenuLink
            class="w-100"
            as="button"
            :href="logout()"
            @click="handleLogout"
            data-test="logout-button"
        >
            <Icon class="nav-icon" name="box-arrow-right" />
            Log out
        </NavigationMenuLink>
    </template>

    <template v-else>
        <DropdownMenuLabel class="p-0 font-normal">
            <div class="icon-link px-2">
                <UserInfo :user="user" :show-email="true" />
            </div>
        </DropdownMenuLabel>
        <DropdownMenuSeparator />
        <DropdownMenuItem class="icon-link" as="button" :href="edit()" prefetch>
            <Icon name="gear" />
            Settings
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <DropdownMenuItem
            class="icon-link"
            as="button"
            :href="logout()"
            @click="handleLogout"
            data-test="logout-button"
        >
            <Icon name="box-arrow-right" />
            Log out
        </DropdownMenuItem>
    </template>
</template>
