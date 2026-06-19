<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { CHeaderToggler } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import { useSidebar } from '@/components/ui/sidebar';
import { cilHamburgerMenu } from '@/icons';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const sidebar = useSidebar();
</script>

<template>
    <CHeaderToggler
        data-slot="sidebar-trigger"
        data-sidebar="trigger"
        :class="props.class"
        @click="sidebar.toggleSidebar"
    >
        <CIcon :icon="cilHamburgerMenu" size="lg" />
        <span class="visually-hidden">Toggle sidebar</span>
    </CHeaderToggler>
</template>
