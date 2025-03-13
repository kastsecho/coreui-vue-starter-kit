<script setup lang="ts">
import type { NavItem } from '@/types';
import { CNavLink } from '@coreui/vue';

defineProps<{
    items: NavItem[];
}>();
</script>

<template>
    <div class="mt-auto">
        <template v-for="item in items" :key="item.title">
            <CNavLink :href="item.href" target="_blank" rel="noopener noreferrer">
                <span class="nav-icon" :class="item.icon" />
                <span>{{ item.title }}</span>
            </CNavLink>
        </template>
    </div>
</template>
