<script setup lang="ts">
import { CDropdownItem } from '@coreui/vue';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

type Props = {
    active?: boolean;
    as?: string;
    disabled?: boolean;
    href?: InertiaLinkProps['href'];
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'a',
});

const delegatedProps = reactiveOmit(props, 'href', 'class');
</script>

<template>
    <Link
        v-if="props.href && typeof props.href !== 'string'"
        data-slot="dropdown-menu-item"
        :href="props.href"
        :class="
            cn(
                'dropdown-item',
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
    <CDropdownItem
        v-else
        data-slot="dropdown-menu-item"
        v-bind="delegatedProps"
        :href="props.href ? toUrl(props.href) : undefined"
        :class="props.class"
    >
        <slot />
    </CDropdownItem>
</template>
