<script setup lang="ts">
import { CPaginationItem } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

const props = defineProps<InertiaLinkProps & {
    active?: boolean;
    disabled?: boolean;
    tabindex?: number;
    method?: Method;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'active', 'class', 'disabled');
</script>

<template>
    <CPaginationItem
        v-if="as === 'a'"
        data-slot="pagination-link"
        as="a"
        :href="toUrl(href!)"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CPaginationItem>
    <li v-else class="page-item">
        <Link
            v-if="as != 'a'"
            data-slot="pagination-link"
            :class="cn({
                ['active']: active,
                ['disabled']: disabled,
            }, 'page-link', props.class)"
            v-bind="delegatedProps"
        >
            <slot/>
        </Link>
    </li>
</template>
