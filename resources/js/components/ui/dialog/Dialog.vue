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
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    align: 'top',
    backdrop: true,
    teleport: true,
});

const visible = defineModel<boolean>('open');
</script>

<template>
    <CModal
        data-slot="dialog"
        v-bind="props"
        :class="props.class"
        :alignment="align"
        :visible="visible"
        @close="visible = !visible"
    >
        <slot/>
    </CModal>
</template>
