<script setup lang="ts">
import { CButtonGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    size?: 'sm' | 'lg';
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
        <slot/>
    </CButtonGroup>
</template>
