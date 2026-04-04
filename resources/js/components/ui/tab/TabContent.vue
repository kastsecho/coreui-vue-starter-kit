<script setup lang="ts">
import { CTabContent } from '@coreui/vue';
import { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTabContent data-slot="tab-content" :class="props.class">
        <slot />
    </CTabContent>
</template>
