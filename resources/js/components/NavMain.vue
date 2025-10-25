<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    NavigationMenuItem,
    NavigationMenuLink,
} from '@/components/ui/navigation-menu';
import { toUrl, urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
    class?: string;
}>();

const page = usePage();
</script>

<template>
    <div>
        <NavigationMenuItem v-for="item in items" :key="toUrl(item.href)">
            <NavigationMenuLink
                class="w-100"
                as="button"
                :href="toUrl(item.href)"
                :active="urlIsActive(item.href, page.url)"
            >
                <Icon v-if="item.icon" class="nav-icon" :name="item.icon" />
                <span>{{ item.title }}</span>
            </NavigationMenuLink>
        </NavigationMenuItem>
    </div>
</template>
