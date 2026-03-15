<script setup lang="ts">
import { CNavLink } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from "@vueuse/core";
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
    <CNavLink
        v-if="as === 'a'"
        data-slot="navigation-menu-link"
        :href="toUrl(href!)"
        as="a"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CNavLink>
    <Link
        v-else
        data-slot="navigation-menu-link"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'nav-link', props.class)"
        v-bind="delegatedProps"
    >
        <slot />
    </Link>
</template>
