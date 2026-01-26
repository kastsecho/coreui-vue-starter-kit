<script setup lang="ts">
import { CHeaderToggler } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import Icon from '@/components/Icon.vue';
import { useSidebar } from '.';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const { toggleSidebar } = useSidebar();
</script>

<template>
    <CHeaderToggler
        data-sidebar="trigger"
        data-slot="sidebar-trigger"
        :class="props.class"
        @click="toggleSidebar"
    >
        <Icon class="icon icon-lg" name="list" />
        <span class="visually-hidden">Toggle Sidebar</span>
    </CHeaderToggler>
</template>
