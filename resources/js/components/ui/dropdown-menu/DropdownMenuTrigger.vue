<script setup lang="ts">
import { CDropdownToggle } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import type { Color, Shape } from '@/types';

type Props = {
    as?: string;
    caret?: boolean;
    color?: Color;
    navLink?: boolean;
    shape?: Shape;
    size?: 'sm' | 'lg';
    split?: boolean;
    splitLabel?: string;
    variant?: 'ghost' | 'outline';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    caret: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CDropdownToggle
        data-slot="dropdown-menu-trigger"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CDropdownToggle>
</template>
