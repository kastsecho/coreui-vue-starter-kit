<script setup lang="ts">
import { CCloseButton } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { reactiveOmit } from '@vueuse/core';
import { useSidebar } from '.';

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
        v-bind="delegatedProps"
        :class="props.class"
        @click="sidebar.toggleSidebar"
    />
</template>
