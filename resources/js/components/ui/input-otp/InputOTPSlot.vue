<script setup lang="ts">
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { computed } from 'vue';
import { useVueOTPContext } from 'vue-input-otp';
import { Input } from '@/components/ui/form';
import { cn } from '@/lib/utils';

type Props = {
    index: number;
    color?: Colors;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'body',
});

const delegatedProps = reactiveOmit(props, 'class');

const context = useVueOTPContext();
const slot = computed(() => context?.value.slots[props.index]);
</script>

<template>
    <Input
        data-slot="input-otp-slot"
        :data-active="slot?.isActive"
        v-bind="delegatedProps"
        type="text"
        inputmode="numeric"
        class="focus-ring-primary text-center"
        :class="
            cn(
                {
                    ['otp-ring focus-ring-primary']: slot?.isActive,
                    [`bg-${props.color}`]: props.color,
                },
                props.class,
            )
        "
        :value="slot?.char"
        :maxlength="1"
        placeholder="o"
    />
</template>
