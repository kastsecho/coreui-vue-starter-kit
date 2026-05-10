<script setup lang="ts">
import { computed } from 'vue';
import { SidebarInset } from '@/components/ui/sidebar';
import { Container } from '@/components/ui/skeleton';
import type { AppVariant } from '@/types';

type Props = {
    container?: boolean;
    variant?: AppVariant;
    class?: string;
};

const props = withDefaults(defineProps<Props>(), {
    variant: 'sidebar',
});
const className = computed(() => props.class);
</script>

<template>
    <SidebarInset v-if="props.variant === 'sidebar'" :class="className">
        <slot />
    </SidebarInset>
    <main v-else :class="className">
        <Container v-if="container">
            <slot />
        </Container>
        <slot v-else />
    </main>
</template>
