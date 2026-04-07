<script setup lang="ts">
import { CButtonGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { ButtonVariants } from '.';

const props = defineProps<{
    size?: ButtonVariants['size'];
    vertical?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CButtonGroup
        data-slot="button-group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CButtonGroup>
</template>
