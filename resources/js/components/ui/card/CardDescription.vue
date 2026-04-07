<script setup lang="ts">
import { CCardText } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'p',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCardText
        data-slot="card-description"
        v-bind="delegatedProps"
        :class="cn('text-muted', props.class)"
    >
        <slot />
    </CCardText>
</template>
