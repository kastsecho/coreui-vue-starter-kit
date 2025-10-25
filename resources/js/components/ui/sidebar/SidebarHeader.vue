<script setup lang="ts">
import { cn } from '@/lib/utils';
import { Container } from '@/types/coreui';
import { CHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    container?: boolean | Container;
    position?: 'fixed' | 'sticky';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CHeader
        data-slot="sidebar-header"
        :class="props.class"
        :container="container"
        :position="position"
    >
        <slot />
    </CHeader>
</template>
