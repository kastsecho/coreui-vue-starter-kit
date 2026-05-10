<script setup lang="ts">
import { CNavGroup } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    compact?: boolean;
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'li',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CNavGroup
        data-slot="sidebar-group"
        data-sidebar="group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <template #togglerContent>
            <slot name="togglerContent" />
        </template>

        <slot />
    </CNavGroup>
</template>
