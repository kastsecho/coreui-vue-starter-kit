<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CDropdownHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    as?: string;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CDropdownHeader
        data-slot="dropdown-menu-label"
        :class="cn('fw-medium', props.class)"
        :as="as"
    >
        <slot />
    </CDropdownHeader>
</template>
