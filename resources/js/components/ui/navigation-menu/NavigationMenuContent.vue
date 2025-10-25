<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CCollapse } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    visible: boolean;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCollapse
        data-slot="navigation-menu-content"
        :class="cn('navbar-collapse', props.class)"
        :visible="visible"
    >
        <slot />
    </CCollapse>
</template>
