<script setup lang="ts">
import { CContainer } from '@coreui/vue';
import { computed } from 'vue';
import { SidebarInset } from '@/components/ui/sidebar';
import type { AppShellVariant } from '@/types';

type Props = {
    container?: boolean;
    variant?: AppShellVariant;
    class?: string;
};

const props = withDefaults(defineProps<Props>(), {
    variant: 'header',
});

const className = computed(() => props.class);
</script>

<template>
    <SidebarInset v-if="props.variant === 'sidebar'" :class="className">
        <slot />
    </SidebarInset>
    <main v-else :class="className">
        <CContainer v-if="container">
            <slot />
        </CContainer>
        <slot v-else />
    </main>
</template>
