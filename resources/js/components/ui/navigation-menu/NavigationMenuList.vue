<script setup lang="ts">
import { CNavbarNav } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavbarNav
        data-slot="navigation-menu-list"
        :class="props.class"
    >
        <slot/>
    </CNavbarNav>
</template>
