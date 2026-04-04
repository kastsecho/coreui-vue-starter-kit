<script setup lang="ts">
import { CTabPanel } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { HTMLAttributes } from 'vue';

type Props = {
    itemKey: number | string;
    transition?: boolean;
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    transition: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTabPanel
        data-slot="tab-panel"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTabPanel>
</template>
