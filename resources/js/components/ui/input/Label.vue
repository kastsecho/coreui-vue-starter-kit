<script setup lang="ts">
import { CFormLabel } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    customClassName?: HTMLAttributes['class'];
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormLabel
        data-slot="label"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot/>
    </CFormLabel>
</template>
