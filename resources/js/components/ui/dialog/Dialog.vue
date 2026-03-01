<script setup lang="ts">
import { CModal } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    align?: 'top' | 'center';
    backdrop?: boolean | 'static';
    contentClassName?: HTMLAttributes['class'];
    scrollable?: boolean;
    size?: 'sm' | 'lg' | 'xl';
    teleport?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    align: 'top',
    backdrop: true,
    teleport: true,
});

const emit = defineEmits(['close']);
const visible = defineModel<boolean>('open');

const closeDialog = () => emit('close');

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CModal
        data-slot="dialog"
        v-bind="delegatedProps"
        :class="props.class"
        :alignment="align"
        :visible="visible"
        @close="closeDialog"
    >
        <slot />
    </CModal>
</template>
