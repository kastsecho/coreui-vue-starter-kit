<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Icon from '@/components/Icon.vue';
import { SidebarGroup, SidebarMenuLink } from '@/components/ui/sidebar';
import UserInfo from '@/components/UserInfo.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { login, register } from '@/routes';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <SidebarGroup v-if="user">
        <template #togglerContent>
            <UserInfo variant="sidebar" :user="user" />
        </template>

        <UserMenuContent variant="sidebar" :user="user" />
    </SidebarGroup>
    <SidebarGroup v-else>
        <template #togglerContent>
            <Icon class="nav-icon" name="person-circle" />
            Account
        </template>

        <SidebarMenuLink :href="login()" prefetch>
            <span class="nav-icon">
                <span class="nav-icon-bullet"></span>
            </span>
            Log in
        </SidebarMenuLink>
        <SidebarMenuLink :href="register()" prefetch>
            <span class="nav-icon">
                <span class="nav-icon-bullet"></span>
            </span>
            Register
        </SidebarMenuLink>
    </SidebarGroup>
</template>
