<script setup lang="ts">
import { CListGroupItem } from '@coreui/vue';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { Color } from '@/types';

const props = defineProps<InertiaLinkProps & {
    active?: boolean;
    as?: string;
    color?: Color;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <Link
        v-if="as != 'a'"
        data-slot="list-group-link"
        v-bind="delegatedProps"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'list-group-item list-group-item-action', props.class)"
    >
        <slot/>
    </Link>
    <CListGroupItem
        v-else
        data-slot="list-group-link"
        as="a"
        :class="props.class"
        :href="href"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CListGroupItem>
</template>
