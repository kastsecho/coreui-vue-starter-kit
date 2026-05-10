<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { SidebarMenuItem } from '@/components/ui/sidebar';
import type { NavItem } from '@/types';

const props = defineProps<{
    items: NavItem[];
    class?: string;
}>();
</script>

<template>
    <div :class="props.class">
        <SidebarMenuItem
            v-for="item in items"
            :key="item.title"
            :href="item.href"
            target="_blank"
            rel="noopener noreferrer"
        >
            <CIcon
                v-if="item.icon"
                custom-class-name="nav-icon"
                :icon="item.icon"
            />
            <span>{{ item.title }}</span>
        </SidebarMenuItem>
    </div>
</template>
