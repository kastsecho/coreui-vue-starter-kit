<script setup lang="ts">
import { CDropdownMenu } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    as?: string;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CDropdownMenu
        data-slot="dropdown-menu-content"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CDropdownMenu>
</template>
