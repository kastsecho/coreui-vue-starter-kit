<script setup lang="ts">
import { CDropdownToggle } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CButtonSize, CButtonVariant, CColor, CShape } from '@/types';

type Props = {
    as?: string;
    caret?: boolean;
    color?: CColor;
    navLink?: boolean;
    shape?: CShape;
    size?: CButtonSize;
    split?: boolean;
    splitLabel?: string;
    variant?: CButtonVariant;
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
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CDropdownToggle>
</template>
