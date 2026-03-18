<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    SidebarGroupLabel,
    SidebarMenuItem,
    SidebarMenuLink,
} from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import type { NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();

const { isCurrentUrl } = useCurrentUrl();
</script>

<template>
    <div>
        <SidebarGroupLabel class="mt-0">Platform</SidebarGroupLabel>
        <SidebarMenuItem v-for="item in items" :key="item.title">
            <SidebarMenuLink
                :href="item.href"
                :active="isCurrentUrl(item.href)"
            >
                <Icon v-if="item.icon" class="nav-icon" :name="item.icon" />
                <span>{{ item.title }}</span>
            </SidebarMenuLink>
        </SidebarMenuItem>
    </div>
</template>
