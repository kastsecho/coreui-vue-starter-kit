<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    SidebarMenuItem,
    SidebarMenuLink,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';

type Props = {
    items: NavItem[];
    class?: string;
};

const props = defineProps<Props>();
</script>

<template>
    <div :class="props.class">
        <SidebarMenuItem v-for="item in items" :key="item.title">
            <SidebarMenuLink
                as="a"
                :href="item.href"
                target="_blank"
                rel="noopener noreferrer"
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
