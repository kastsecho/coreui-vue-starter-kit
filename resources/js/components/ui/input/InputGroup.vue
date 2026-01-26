<script setup lang="ts">
import { CInputGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    size?: 'sm' | 'lg';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CInputGroup
        data-slot="input-group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot/>
    </CInputGroup>
</template>
