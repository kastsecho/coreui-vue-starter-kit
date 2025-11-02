<script setup lang="ts">
import { CCloseButton } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    dark?: boolean;
    disabled?: boolean;
    white?: boolean;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCloseButton
        data-slot="sidebar-menu-button"
        :class="props.class"
        :dark="dark"
        :disabled="disabled"
        :white="white"
    />
</template>
