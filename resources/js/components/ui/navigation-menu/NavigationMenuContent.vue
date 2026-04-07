<script setup lang="ts">
import { CCollapse } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    visible: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCollapse
        data-slot="navigation-menu-content"
        v-bind="delegatedProps"
        :class="cn('navbar-collapse', props.class)"
    >
        <slot />
    </CCollapse>
</template>
