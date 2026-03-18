<script setup lang="ts">
import { CListGroupItem } from '@coreui/vue';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { CColor } from '@/types';

const props = defineProps<InertiaLinkProps & {
    active?: boolean;
    color?: CColor;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'active', 'class', 'disabled');
</script>

<template>
    <CListGroupItem
        v-if="as === 'a'"
        data-slot="list-group-link"
        :href="href"
        as="a"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CListGroupItem>
    <Link
        v-else
        data-slot="list-group-link"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'list-group-item list-group-item-action', props.class)"
        v-bind="delegatedProps"
    >
        <slot />
    </Link>
</template>
