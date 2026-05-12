<script lang="ts" setup>
import { CBreadcrumbItem } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';
import type { TextColors } from '@/types';

const props = defineProps<{
    active?: boolean;
    disabled?: boolean;
    href?: InertiaLinkProps['href'];
    tabindex?: number;
    method?: Method;
    textColor?: TextColors;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'href', 'method', 'class');
</script>

<template>
    <Link
        v-if="props.href && typeof props.href !== 'string'"
        data-slot="breadcrumb-link"
        :href="props.href"
        :method="props.method"
        :tabindex="props.tabindex"
        :class="
            cn(
                'breadcrumb-item',
                {
                    active: props.active,
                    [`link-${props.textColor}`]: props.textColor,
                },
                props.class,
            )
        "
    >
        <slot />
    </Link>
    <CBreadcrumbItem
        v-else
        data-slot="breadcrumb-link"
        v-bind="delegatedProps"
        :href="props.href ? toUrl(props.href) : undefined"
        :class="props.class"
    >
        <slot />
    </CBreadcrumbItem>
</template>
