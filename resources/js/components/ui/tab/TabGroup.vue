<script setup lang="ts">
import { CTabs } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { HTMLAttributes } from 'vue';

const props = defineProps<{
    activeItemKey: number | string;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTabs data-slot="tab-group" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CTabs>
</template>
