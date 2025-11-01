<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CToast } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    autohide?: boolean;
    delay?: number;
    color?: Color;
    dismissible?: boolean;
    visible?: boolean;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    autohide: true,
    delay: 5000,
    visible: true,
});
</script>

<template>
    <CToast
        data-slot="toast"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CToast>
</template>
