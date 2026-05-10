<script setup lang="ts">
import { CDropdownToggle } from '@coreui/vue';
import type { Colors, Shapes, Triggers } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    color?: Colors;
    caret?: boolean;
    custom?: boolean;
    disabled?: boolean;
    navLink?: boolean;
    shape?: Shapes;
    size?: 'sm' | 'lg';
    split?: boolean;
    splitLabel?: string;
    trigger?: Triggers;
    variant?: 'ghost' | 'outline';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'button',
    caret: true,
    navLink: true,
    splitLabel: 'Toggle Dropdown',
    trigger: 'click',
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
