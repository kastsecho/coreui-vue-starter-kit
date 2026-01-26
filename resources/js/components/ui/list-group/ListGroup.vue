<script setup lang="ts">
import { CListGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { type Breakpoint } from '@/types/coreui';

type Layout = 'horizontal' | `horizontal-${Breakpoint}`;

const props = defineProps<{
    as?: string;
    flush?: boolean;
    layout?: Layout;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CListGroup
        data-slot="list-group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot/>
    </CListGroup>
</template>
