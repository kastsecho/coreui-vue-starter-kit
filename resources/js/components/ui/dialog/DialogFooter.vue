<script setup lang="ts">
import { CModalFooter } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    closeButton?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CModalFooter
        data-slot="dialog-footer"
        v-bind="delegatedProps"
        :class="cn('d-flex justify-content-end gap-2', props.class)"
    >
        <slot />
    </CModalFooter>
</template>
