<script setup lang="ts">
import { CDropdownDivider } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CDropdownDivider
        data-slot="dropdown-menu-separator"
        :class="props.class"
    />
</template>
