<script setup lang="ts">
import { reactiveOmit } from '@vueuse/core'
import type { HTMLAttributes } from 'vue';
import { computed } from 'vue';
import { useVueOTPContext } from 'vue-input-otp';
import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils';
import type { BackgroundColor } from '@/types';

type Props = {
    index: number;
    color?: BackgroundColor;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'dark',
});

const delegatedProps = reactiveOmit(props, 'class')

const context = useVueOTPContext();

const slot = computed(() => context?.value.slots[props.index])
</script>

<template>
    <Input
        v-bind="delegatedProps"
        data-slot="input-otp-slot"
        :data-active="slot?.isActive"
        type="text"
        inputmode="numeric"
        class="text-center focus-ring-primary"
        :class="cn({
            ['otp-ring focus-ring-primary']: slot?.isActive,
            [`bg-${props.color}`]: props.color,
        }, props.class)"
        :value="slot?.char"
        :maxlength="1"
        placeholder="o"
    />
</template>
