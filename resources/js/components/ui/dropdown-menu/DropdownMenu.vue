<script setup lang="ts">
import { CDropdown } from '@coreui/vue';
import type { Alignments } from '@coreui/vue/src/components/dropdown/types';
import type { Triggers } from '@coreui/vue/src/types';
import type { Placement } from '@popperjs/core';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes, Ref } from 'vue';

type Props = {
    alignment?: string | Alignments;
    autoClose?: boolean | 'inside' | 'outside';
    container?: HTMLElement | (() => HTMLElement) | string;
    dark?: boolean;
    direction?: 'center' | 'dropup' | 'dropup-center' | 'dropend' | 'dropstart';
    disabled?: boolean;
    offset?: number[];
    placement?: Placement;
    popper?: boolean;
    reference?: 'parent' | 'toggle' | HTMLElement | Ref<HTMLElement | null>;
    teleport?: boolean;
    trigger?: Triggers;
    variant?: 'btn-group' | 'dropdown' | 'input-group' | 'nav-item';
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    autoClose: true,
    container: 'body',
    placement: 'bottom-start',
    popper: true,
    reference: 'toggle',
    teleport: false,
    trigger: 'click',
    variant: 'dropdown',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CDropdown
        data-slot="dropdown-menu"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CDropdown>
</template>
