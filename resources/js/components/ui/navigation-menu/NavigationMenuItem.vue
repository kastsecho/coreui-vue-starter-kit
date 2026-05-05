<script setup lang="ts">
import { CNavItem, CNavLink } from '@coreui/vue';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import { cn, toUrl } from '@/lib/utils';

type Props = {
    active?: boolean;
    as?: string;
    disabled?: boolean;
    href?: InertiaLinkProps['href'];
    class?: string;
};

const props = withDefaults(defineProps<Props>(), {
    as: 'li',
});

const delegatedProps = reactiveOmit(props, 'href', 'class');
</script>

<template>
    <CNavItem
        v-if="props.href && typeof props.href !== 'string'"
        data-slot="navigation-menu-item"
        v-bind="delegatedProps"
    >
        <Link
            :href="props.href"
            :class="
                cn(
                    'nav-link',
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
    </CNavItem>
    <CNavItem v-else data-slot="navigation-menu-item" v-bind="delegatedProps">
        <CNavLink
            v-if="props.href && typeof props.href === 'string'"
            :href="toUrl(props.href)"
            :class="props.class"
        >
            <slot />
        </CNavLink>
        <slot v-else />
    </CNavItem>
</template>
