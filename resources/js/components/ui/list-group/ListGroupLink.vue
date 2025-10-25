<script setup lang="ts">
import { cn, toUrl } from '@/lib/utils';
import type { Color } from '@/types/coreui';
import { CListGroupItem } from '@coreui/vue';
import { type InertiaLinkProps, Link } from '@inertiajs/vue3';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<InertiaLinkProps & {
    active?: boolean;
    as?: string;
    color?: Color;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();

const href = computed(() => toUrl(props.href ? props.href : ''));
</script>

<template>
    <Link
        v-if="as != 'a'"
        data-slot="list-group-link"
        v-bind="props"
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
        :class="props.class"
        :href="href"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CListGroupItem>
</template>
