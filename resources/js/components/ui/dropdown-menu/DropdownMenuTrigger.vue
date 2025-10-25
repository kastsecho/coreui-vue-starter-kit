<script setup lang="ts">
import type { Color, Shape } from '@/types/coreui';
import { CDropdownToggle } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
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
}>();
</script>

<template>
    <CDropdownToggle
        data-slot="dropdown-menu-trigger"
        v-bind="props"
    >
        <slot/>
    </CDropdownToggle>
</template>
