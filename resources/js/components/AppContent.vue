<script setup lang="ts">
import { CContainer } from '@coreui/vue';
import { computed } from 'vue';
import { SidebarInset } from '@/components/ui/sidebar';
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
    <main v-if="variant === 'header'" class="py-4" :class="className">
        <CContainer v-if="container">
            <slot />
        </CContainer>
        <slot v-else />
    </main>
    <SidebarInset v-else :class="className">
        <slot />
    </SidebarInset>
</template>
