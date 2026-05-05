<script setup lang="ts">
import { CListGroupItem } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import { cn, toUrl } from '@/lib/utils';

type Props = {
    active?: boolean;
    as?: string;
    color?: Colors;
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
    <Link
        v-if="props.href && typeof props.href !== 'string'"
        data-slot="list-group-item"
        :href="props.href"
        :aria-current="props.active"
        :aria-disabled="props.disabled"
        :class="
            cn(
                'list-group-item list-group-item-action',
                {
                    [`list-group-item-${props.color}`]: props.color,
                    active: props.active,
                    disabled: props.disabled,
                },
                props.class,
            )
        "
    >
        <slot />
    </Link>
    <CListGroupItem
        v-else
        data-slot="list-group-item"
        v-bind="delegatedProps"
        :href="props.href ? toUrl(props.href) : undefined"
    >
        <slot />
    </CListGroupItem>
</template>
