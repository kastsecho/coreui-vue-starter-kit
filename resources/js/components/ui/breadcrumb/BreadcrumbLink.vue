<script lang="ts" setup>
import { CBreadcrumbItem } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

const props = defineProps<
    InertiaLinkProps & {
        active?: boolean;
        disabled?: boolean;
        tabindex?: number;
        method?: Method;
        class?: HTMLAttributes['class'];
    }
>();

const delegatedProps = reactiveOmit(props, 'active', 'class', 'disabled');
</script>

<template>
    <CBreadcrumbItem
        v-if="as === 'a'"
        data-slot="breadcrumb-link"
        :href="toUrl(href!)"
        as="a"
        :class="cn('breadcrumb-item link-body-emphasis', props.class)"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CBreadcrumbItem>
    <Link
        v-else
        data-slot="breadcrumb-link"
        v-bind="delegatedProps"
        :class="
            cn(
                {
                    ['active']: active,
                    ['disabled']: disabled,
                },
                'breadcrumb-item link-body-emphasis',
                props.class,
            )
        "
    >
        <slot />
    </Link>
</template>
