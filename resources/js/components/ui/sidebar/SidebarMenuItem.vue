<script setup lang="ts">
import { CNavItem, CNavLink } from '@coreui/vue';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import { cn, toUrl } from '@/lib/utils';

defineOptions({ inheritAttrs: false });

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
        data-slot="sidebar-menu-item"
        data-sidebar="menu-item"
        v-bind="delegatedProps"
    >
        <CNavLink
            v-if="props.href && typeof props.href === 'string'"
            v-bind="$attrs"
            :href="toUrl(props.href)"
            :class="props.class"
        >
            <slot />
        </CNavLink>
        <Link
            v-else-if="props.href && typeof props.href !== 'string'"
            :href="props.href"
            v-bind="$attrs"
            :class="
                cn(
                    'nav-link',
                    'w-100',
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
        <slot v-else v-bind="$attrs" />
    </CNavItem>
</template>
