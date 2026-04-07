<script setup lang="ts">
import { CModal } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    alignment?: 'top' | 'center';
    backdrop?: boolean | 'static';
    contentClassName?: string;
    scrollable?: boolean;
    size?: 'sm' | 'lg' | 'xl';
    teleport?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    alignment: 'top',
    backdrop: true,
    teleport: true,
});

const emit = defineEmits(['close']);
const delegatedProps = reactiveOmit(props, 'class');

const visible = defineModel<boolean>('open');
const closeDialog = () => emit('close');
</script>

<template>
    <CModal
        data-slot="dialog"
        v-bind="delegatedProps"
        :class="props.class"
        :visible="visible"
        @close="closeDialog"
    >
        <slot />
    </CModal>
</template>
