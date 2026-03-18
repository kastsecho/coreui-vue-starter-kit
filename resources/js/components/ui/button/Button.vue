<script setup lang="ts">
import { CButton } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { ButtonVariants } from '.';

type Props = {
    active?: boolean;
    color?: ButtonVariants['color'];
    shape?: ButtonVariants['shape'];
    size?: ButtonVariants['size'];
    variant?: ButtonVariants['variant'];
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
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CButton>
</template>
