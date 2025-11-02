<script setup lang="ts">
import { SidebarInset } from '@/components/ui/sidebar';
import { CContainer } from '@coreui/vue';
import { computed, type HTMLAttributes } from 'vue';

interface Props {
    container?: boolean;
    variant?: 'header' | 'sidebar';
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();
const className = computed(() => props.class);
</script>

<template>
    <SidebarInset v-if="props.variant === 'sidebar'" :class="className">
        <slot />
    </SidebarInset>
    <main
        v-else
        class="d-flex h-100 w-100 flex-grow-1 flex-column"
        :class="className"
    >
        <CContainer v-if="container">
            <slot />
        </CContainer>
        <slot v-else />
    </main>
</template>
