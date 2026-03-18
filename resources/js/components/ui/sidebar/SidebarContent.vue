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
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CSidebarNav>
</template>
