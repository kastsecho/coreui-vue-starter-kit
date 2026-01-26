<script setup lang="ts">
import { CButton } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { Color, Shape } from '@/types';

type Props = {
    active?: boolean;
    color?: Color;
    shape?: Shape;
    size?: 'sm' | 'lg';
    variant?: 'ghost' | 'outline';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'primary',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
  <CButton
    data-slot="button"
    v-bind="delegatedProps"
    :class="props.class"
  >
    <slot />
  </CButton>
</template>
