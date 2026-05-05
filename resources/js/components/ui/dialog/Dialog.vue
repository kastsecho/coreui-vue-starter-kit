<script setup lang="ts">
import { CModal } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

defineOptions({ inheritAttrs: false });

type Props = {
    alignment?: 'top' | 'center';
    backdrop?: boolean | 'static';
    container?: HTMLElement | (() => HTMLElement) | string;
    contentClassName?: string;
    focus?: boolean;
    fullscreen?: boolean | 'sm' | 'md' | 'lg' | 'xl' | 'xxl';
    keyboard?: boolean;
    scrollable?: boolean;
    size?: 'sm' | 'lg' | 'xl';
    teleport?: boolean;
    transition?: boolean;
    unmountOnClose?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    alignment: 'top',
    backdrop: true,
    container: 'body',
    focus: true,
    keyboard: true,
    teleport: false,
    transition: true,
    unmountOnClose: true,
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
