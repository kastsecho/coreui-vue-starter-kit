<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import {
    SidebarGroupLabel,
    SidebarGroup,
} from '@/components/ui/sidebar';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <SidebarGroupLabel>Platform</SidebarGroupLabel>
    <SidebarGroup>
        <template #togglerContent>
            <UserInfo variant="sidebar" :user="user" />
        </template>

        <UserMenuContent variant="sidebar" :user="user" />
    </SidebarGroup>
</template>
