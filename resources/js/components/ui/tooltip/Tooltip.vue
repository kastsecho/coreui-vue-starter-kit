<script setup lang="ts">
import { CTooltip } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

type Placement = 'top' | 'right' | 'bottom' | 'left';

const props = defineProps<{
    animation?: boolean;
    content: string;
    delay?: number | { show: number; hide: number };
    placement?: Placement;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTooltip
        data-slot="tooltip"
        v-bind="props"
        :class="props.class"
    >
        <template #toggler="{ id, on }">
            <slot :id="id" :on="on" />
        </template>
    </CTooltip>
</template>
