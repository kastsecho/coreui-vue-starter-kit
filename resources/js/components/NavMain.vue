<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    SidebarMenuItem,
    SidebarMenuLink,
} from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { type NavItem } from '@/types';

const { isCurrentUrl } = useCurrentUrl();

defineProps<{
    items: NavItem[];
}>();
</script>

<template>
    <div>
        <SidebarMenuItem v-for="item in items" :key="item.title">
            <SidebarMenuLink
                class="w-100"
                as="button"
                :href="item.href"
                :active="isCurrentUrl(item.href)"
            >
                <Icon
                    v-if="item.icon"
                    class="nav-icon"
                    :name="item.icon"
                />
                <span>{{ item.title }}</span>
            </SidebarMenuLink>
        </SidebarMenuItem>
    </div>
</template>
