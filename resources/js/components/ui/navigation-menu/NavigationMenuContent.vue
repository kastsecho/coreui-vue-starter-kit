<script setup lang="ts">
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import { Collapsible } from '@/components/ui/collapsible';
import { cn } from '@/lib/utils';

const props = defineProps<{
    visible: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <Collapsible
        data-slot="navigation-menu-content"
        v-bind="delegatedProps"
        :class="cn('navbar-collapse', props.class)"
    >
        <slot />
    </Collapsible>
</template>
