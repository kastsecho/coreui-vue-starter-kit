<script setup lang="ts">
import { CCloseButton } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { useSidebar } from '@/components/ui/sidebar';

const props = defineProps<{
    dark?: boolean;
    disabled?: boolean;
    white?: boolean;
    class?: HTMLAttributes['class'];
}>();

const sidebar = useSidebar();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCloseButton
        data-slot="sidebar-menu-button"
        :class="props.class"
        v-bind="delegatedProps"
        @click="sidebar.toggleSidebar"
    />
</template>
