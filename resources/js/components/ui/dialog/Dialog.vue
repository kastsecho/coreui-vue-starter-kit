<script setup lang="ts">
import { CModal } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    align?: 'top' | 'center';
    backdrop?: boolean | 'static';
    contentClassName?: HTMLAttributes['class'];
    scrollable?: boolean;
    size?: 'sm' | 'lg' | 'xl';
    teleport?: boolean;
    visible?: boolean;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    align: 'top',
    backdrop: true,
    teleport: true,
});
</script>

<template>
    <CModal
        data-slot="dialog"
        v-bind="props"
        :class="props.class"
        :alignment="align"
    >
        <slot/>
    </CModal>
</template>
