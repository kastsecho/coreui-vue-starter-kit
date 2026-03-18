<script setup lang="ts">
import { CDropdownItem } from '@coreui/vue';
import type { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
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
    <CDropdownItem
        v-if="as === 'a'"
        data-slot="dropdown-menu-link"
        :href="toUrl(href!)"
        as="a"
        :class="props.class"
        :active="active"
        :disabled="disabled"
    >
        <slot />
    </CDropdownItem>
    <Link
        v-else
        data-slot="dropdown-menu-link"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'dropdown-item', props.class)"
        v-bind="delegatedProps"
    >
        <slot />
    </Link>
</template>
