<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import UserInfo from '@/components/UserInfo.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <DropdownMenu class="w-100" variant="nav-item" direction="dropup">
        <DropdownMenuTrigger
            as="button"
            :caret="false"
            class="btn btn-ghost d-flex justify-content-center align-items-center w-100 gap-2 p-1"
        >
            <UserInfo variant="sidebar" :user="user" :show-email="true" />
        </DropdownMenuTrigger>
        <DropdownMenuContent class="rounded-4 w-100">
            <UserMenuContent :user="user" />
        </DropdownMenuContent>
    </DropdownMenu>
</template>
