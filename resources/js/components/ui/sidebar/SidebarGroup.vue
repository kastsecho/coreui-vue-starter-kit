<script setup lang="ts">
import { CNavGroup } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavGroup
        data-slot="sidebar-trigger"
        :class="props.class"
    >
        <template #togglerContent>
            <slot name="togglerContent" />
        </template>

        <slot />
    </CNavGroup>
</template>
