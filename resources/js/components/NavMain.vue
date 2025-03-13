<script setup lang="ts">
import type { NavItem, SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage<SharedData>();
</script>

<template>
    <div>
        <template v-for="item in items" :key="item.title">
            <Link class="nav-link" :class="{ active: item.href === page.url }" :href="item.href">
                <span class="nav-icon" :class="item.icon" />
                <span>{{ item.title }}</span>
            </Link>
        </template>
    </div>
</template>
