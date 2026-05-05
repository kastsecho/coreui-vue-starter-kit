<script setup lang="ts">
import { CListGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    flush?: boolean;
    layout?:
        | 'horizontal'
        | 'horizontal-sm'
        | 'horizontal-md'
        | 'horizontal-lg'
        | 'horizontal-xl'
        | 'horizontal-xxl';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'ul',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CListGroup
        data-slot="list-group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CListGroup>
</template>
