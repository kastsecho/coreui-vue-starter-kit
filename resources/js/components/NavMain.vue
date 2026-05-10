<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { SidebarGroupLabel, SidebarMenuItem } from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import type { NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();

const { isCurrentUrl } = useCurrentUrl();
</script>

<template>
    <SidebarGroupLabel class="my-0">Platform</SidebarGroupLabel>
    <SidebarMenuItem
        v-for="item in items"
        :key="item.title"
        :href="item.href"
        link-as="Link"
        :active="isCurrentUrl(item.href)"
    >
        <CIcon
            v-if="item.icon"
            custom-class-name="nav-icon"
            :icon="item.icon"
        />
        <span>{{ item.title }}</span>
    </SidebarMenuItem>
</template>
