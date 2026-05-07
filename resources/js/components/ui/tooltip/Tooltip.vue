<script setup lang="ts">
import { CTooltip } from '@coreui/vue';
import type { Placements, Triggers } from '@coreui/vue/src/types';
import type { Placement } from '@popperjs/core';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    animation?: boolean;
    container?: HTMLElement | (() => HTMLElement) | string;
    content: string;
    delay?: number | { show: number; hide: number };
    fallbackPlacements?: Placements | Placements[];
    offset?: number[];
    placement?: Placement;
    trigger?: Triggers | Triggers[];
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    animation: true,
    container: 'body',
    delay: 0,
    fallbackPlacements: () => ['top', 'right', 'bottom', 'left'],
    offset: () => [0, 6],
    placement: 'top',
    trigger: () => ['hover', 'focus'],
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTooltip data-slot="tooltip" v-bind="delegatedProps" :class="props.class">
        <template #toggler="{ id, on }">
            <slot :id="id" :on="on" />
        </template>
    </CTooltip>
</template>
