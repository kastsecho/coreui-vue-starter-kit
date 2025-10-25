<script setup lang="ts">
import { CListGroup } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

type Layout =
    | 'horizontal'
    | 'horizontal-sm'
    | 'horizontal-md'
    | 'horizontal-lg'
    | 'horizontal-xl'
    | 'horizontal-xxl';

const props = defineProps<{
    as?: string;
    flush?: boolean;
    layout?: Layout;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CListGroup
        data-slot="list-group"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CListGroup>
</template>
