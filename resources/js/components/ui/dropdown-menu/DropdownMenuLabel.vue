<script setup lang="ts">
import { CDropdownHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'h6',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CDropdownHeader
        data-slot="dropdown-menu-label"
        v-bind="delegatedProps"
        :class="cn('fw-medium', props.class)"
    >
        <slot />
    </CDropdownHeader>
</template>
