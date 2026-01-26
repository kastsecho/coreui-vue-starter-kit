<script setup lang="ts">
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { InputGroup } from '@/components/ui/input';

const props = defineProps<{
    size?: 'sm' | 'lg';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <InputGroup
        data-slot="input-otp-group"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </InputGroup>
</template>
