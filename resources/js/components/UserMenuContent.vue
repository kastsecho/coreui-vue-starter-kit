<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import type { User } from '@/types';
import { CDropdownDivider, CDropdownHeader, CDropdownItem, CNavLink } from '@coreui/vue';
import { Link, router } from '@inertiajs/vue3';

interface Props {
    user: User;
    variant?: string;
}

withDefaults(defineProps<Props>(), {
    variant: 'dropdown',
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <template v-if="variant === 'sidebar'">
        <Link class="nav-link" :href="route('profile.edit')">
            <span class="nav-icon">
                <span class="nav-icon-bullet"></span>
            </span>
            Settings
        </Link>

        <!-- Authentication -->
        <form @submit.prevent="logout">
            <CNavLink as="button" type="submit" class="w-100">
                <span class="nav-icon">
                    <span class="nav-icon-bullet"></span>
                </span>
                Log Out
            </CNavLink>
        </form>
    </template>

    <template v-else>
        <CDropdownHeader class="d-flex align-items-center gap-2 text-start">
            <UserInfo :user show-email />
        </CDropdownHeader>
        <CDropdownDivider />
        <Link class="dropdown-item" :href="route('profile.edit')">Settings</Link>
        <CDropdownDivider />
        <!-- Authentication -->
        <form @submit.prevent="logout">
            <CDropdownItem as="button" type="submit">Log Out</CDropdownItem>
        </form>
    </template>
</template>
