<script setup lang="ts">
import { CAlertHeading } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'h4',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CAlertHeading
        data-slot="alert-title"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CAlertHeading>
</template>
