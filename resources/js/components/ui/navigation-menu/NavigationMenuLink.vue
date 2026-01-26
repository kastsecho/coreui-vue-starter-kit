<script setup lang="ts">
import { CNavLink } from '@coreui/vue';
import { type Method } from '@inertiajs/core';
import { type InertiaLinkProps, Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { toUrl } from '@/lib/utils';
import { cn } from '@/lib/utils';

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
        data-slot="navigation-menu-link"
        v-bind="delegatedProps"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'nav-link', props.class)"
    >
        <slot />
    </Link>
    <CNavLink
        v-else
        data-slot="navigation-menu-link"
        as="a"
        :href="toUrl(href!)"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CNavLink>
</template>
