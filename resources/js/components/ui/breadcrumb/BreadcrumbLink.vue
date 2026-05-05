<script lang="ts" setup>
import { CBreadcrumbItem } from '@coreui/vue';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

const props = defineProps<{
    active?: boolean;
    href?: InertiaLinkProps['href'];
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'href', 'class');
</script>

<template>
    <Link
        v-if="props.href && typeof props.href !== 'string'"
        data-slot="breadcrumb-link"
        :href="props.href"
        :class="
            cn(
                'breadcrumb-item',
                {
                    active: props.active,
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
