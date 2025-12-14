<script setup lang="ts">
import type { Placement } from '@/types/coreui';
import { CDropdown } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    align?: 'start' | 'end';
    autoClose?: boolean | 'inside' | 'outside';
    placement?: Placement;
    teleport?: boolean;
    variant?: 'btn-group' | 'dropdown' | 'input-group' | 'nav-item';
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    autoClose: true,
});
</script>

<template>
    <CDropdown
        data-slot="dropdown-menu"
        v-bind="props"
        :class="props.class"
        :alignment="align"
    >
        <slot />
    </CDropdown>
</template>
