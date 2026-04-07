<script setup lang="ts">
import { CNavLink } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { toUrl } from '@/lib/utils';
import { cn } from '@/lib/utils';

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
    <CNavLink
        v-if="as === 'a'"
        data-slot="sidebar-menu-item"
        data-sidebar="menu-link"
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
        data-slot="sidebar-menu-link"
        data-sidebar="menu-link"
        v-bind="delegatedProps"
        :class="
            cn(
                {
                    ['active']: active,
                    ['disabled']: disabled,
                },
                'nav-link',
                props.class,
            )
        "
    >
        <slot />
    </Link>
</template>
