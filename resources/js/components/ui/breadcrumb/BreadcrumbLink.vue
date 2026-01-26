<script lang="ts" setup>
import { CBreadcrumbItem } from '@coreui/vue';
import { type Method } from '@inertiajs/core';
import { type InertiaLinkProps, Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
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
    <Link
        v-if="as !== 'a'"
        data-slot="breadcrumb-link"
        v-bind="delegatedProps"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'dropdown-item', props.class)"
    >
        <slot />
    </Link>
    <CBreadcrumbItem
        v-else
        data-slot="breadcrumb-link"
        as="a"
        :href="toUrl(href!)"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CBreadcrumbItem>
</template>
