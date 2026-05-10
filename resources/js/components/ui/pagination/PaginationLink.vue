<script setup lang="ts">
import { CPaginationItem } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

const props = defineProps<{
    as?: string;
    active?: boolean;
    disabled?: boolean;
    href?: InertiaLinkProps['href'];
    tabindex?: number;
    method?: Method;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'href', 'method', 'class');
</script>

<template>
    <li v-if="props.href && typeof props.href !== 'string'" class="page-item">
        <Link
            data-slot="pagination-link"
            :href="props.href"
            :method="props.method"
            :tabindex="props.tabindex"
            :class="
                cn(
                    'page-link',
                    {
                        active: props.active,
                        disabled: props.disabled,
                    },
                    props.class,
                )
            "
        >
            <slot />
        </Link>
    </li>
    <CPaginationItem
        v-else
        data-slot="pagination-link"
        v-bind="delegatedProps"
        :href="props.href ? toUrl(props.href) : undefined"
        :class="props.class"
    >
        <slot />
    </CPaginationItem>
</template>
