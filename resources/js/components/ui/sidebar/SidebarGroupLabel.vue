<script setup lang="ts">
import { CNavTitle } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavTitle
        data-slot="sidebar-group-label"
        :class="props.class"
    >
        <slot />
    </CNavTitle>
</template>
