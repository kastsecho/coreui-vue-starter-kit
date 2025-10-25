<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    NavigationMenuItem,
    NavigationMenuLink,
} from '@/components/ui/navigation-menu';
import { toUrl } from '@/lib/utils';
import { type NavItem } from '@/types';

defineProps<{
    items: NavItem[];
    class?: string;
}>();
</script>

<template>
    <div class="mt-auto">
        <NavigationMenuItem v-for="item in items" :key="toUrl(item.href)">
            <NavigationMenuLink
                as="a"
                :href="toUrl(item.href)"
                target="_blank"
                rel="noopener noreferrer"
            >
                <Icon v-if="item.icon" class="nav-icon" :name="item.icon" />
                <span>{{ item.title }}</span>
            </NavigationMenuLink>
        </NavigationMenuItem>
    </div>
</template>
