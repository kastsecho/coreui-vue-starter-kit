<script setup lang="ts">
import { CButton } from '@coreui/vue';
import type { Colors, Shapes } from '@coreui/vue/src/types';
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn, toUrl } from '@/lib/utils';

type Props = {
    active?: boolean;
    as?: string;
    color?: Colors;
    disabled?: boolean;
    href?: InertiaLinkProps['href'];
    shape?: Shapes;
    size?: 'sm' | 'lg';
    type?: 'button' | 'submit' | 'reset';
    variant?: 'ghost' | 'outline';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'button',
    color: 'primary',
    type: 'button',
});

const delegatedProps = reactiveOmit(props, 'href', 'class');
</script>

<template>
    <Link
        v-if="!['a', 'button'].includes(props.as)"
        data-slot="button"
        :href="props.href"
        :class="
            cn(
                'btn',
                {
                    [`btn-${props.variant}-${props.color}`]:
                        props.color && props.variant,
                    [`btn-${props.variant}`]: !props.color && props.variant,
                    [`btn-${props.color}`]: props.color && !props.variant,
                    [`btn-${props.size}`]: props.size,
                    active: props.active,
                    disabled: props.disabled,
                },
                props.shape,
                props.class,
            )
        "
    >
        <slot />
    </Link>
    <CButton
        v-else
        data-slot="button"
        v-bind="delegatedProps"
        :href="props.href ? toUrl(props.href) : undefined"
        :class="props.class"
    >
        <slot />
    </CButton>
</template>
