<script setup lang="ts">
import { CTab } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { HTMLAttributes } from 'vue';

const props = defineProps<{
    disabled?: boolean;
    itemKey: number | string;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTab data-slot="tab-item" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CTab>
</template>
