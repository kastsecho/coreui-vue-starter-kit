<script setup lang="ts">
import { CCardText } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { TextColors } from '@/types';

type Props = {
    as?: string;
    textColor?: TextColors;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'p',
});

const delegatedProps = reactiveOmit(props, 'textColor', 'class');
</script>

<template>
    <CCardText
        data-slot="card-description"
        v-bind="delegatedProps"
        :class="
            cn(
                {
                    [`text-${textColor}`]: textColor,
                },
                props.class,
            )
        "
    >
        <slot />
    </CCardText>
</template>
