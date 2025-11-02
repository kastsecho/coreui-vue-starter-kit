<script setup lang="ts">
import { InputGroup } from '@/components/ui/input';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <InputGroup
        data-slot="pin-input-group"
        :class="props.class"
    >
        <slot />
    </InputGroup>
</template>
