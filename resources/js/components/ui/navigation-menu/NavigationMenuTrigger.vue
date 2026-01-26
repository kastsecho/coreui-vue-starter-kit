<script setup lang="ts">
import { CNavbarToggler } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavbarToggler
        data-slot="navigation-menu-trigger"
        :class="props.class"
    />
</template>
