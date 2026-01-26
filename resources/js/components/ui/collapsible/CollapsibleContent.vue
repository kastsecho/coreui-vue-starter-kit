<script setup lang="ts">
import { CCollapse } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { reactiveOmit } from '@vueuse/core';

const props = defineProps<{
    visible: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCollapse
        data-slot="collapsible-content"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CCollapse>
</template>
