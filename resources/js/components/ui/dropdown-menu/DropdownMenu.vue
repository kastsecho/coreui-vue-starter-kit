<script setup lang="ts">
import { CDropdown } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CDropdownPlacement } from '@/types';

type Props = {
    align?: 'start' | 'end';
    autoClose?: boolean | 'inside' | 'outside';
    placement?: CDropdownPlacement;
    teleport?: boolean;
    variant?: 'btn-group' | 'dropdown' | 'input-group' | 'nav-item';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    autoClose: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CDropdown
        data-slot="dropdown-menu"
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CDropdown>
</template>
