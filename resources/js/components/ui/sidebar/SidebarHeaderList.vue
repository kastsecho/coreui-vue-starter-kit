<script setup lang="ts">
import { CHeaderNav } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CHeaderNav
        data-slot="sidebar-header-list"
        :class="props.class"
    >
        <slot/>
    </CHeaderNav>
</template>
