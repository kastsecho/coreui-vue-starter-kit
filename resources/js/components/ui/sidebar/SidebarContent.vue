<script setup lang="ts">
import { CSidebarNav } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { Component, HTMLAttributes } from 'vue';

const props = defineProps<{
    as?: string | Component;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CSidebarNav
        data-slot="sidebar-content"
        data-sidebar="content"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CSidebarNav>
</template>
