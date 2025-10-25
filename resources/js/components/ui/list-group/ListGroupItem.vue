<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CListGroupItem } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    active?: boolean;
    as?: string;
    color?: Color;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();
</script>

<template>
    <CListGroupItem
        data-slot="list-group-item"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CListGroupItem>
</template>
