<script setup lang="ts">
import { CTabList } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { HTMLAttributes } from 'vue';

const props = defineProps<{
    layout?: 'fill' | 'justified';
    variant?:
        | 'enclosed'
        | 'enclosed-pills'
        | 'pills'
        | 'tabs'
        | 'underline'
        | 'underline-border';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTabList data-slot="tab-list" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CTabList>
</template>
