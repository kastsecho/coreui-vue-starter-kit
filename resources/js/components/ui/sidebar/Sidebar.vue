<script setup lang="ts">
import { useSidebar } from '.';
import { cn } from '@/lib/utils';
import { CSidebar } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';
import { type HTMLAttributes, onMounted } from 'vue';

interface Props {
    colorScheme?: 'dark' | 'light';
    narrow?: boolean;
    overlaid?: boolean;
    placement?: 'start' | 'end';
    position?: 'fixed';
    size?: 'sm' | 'lg' | 'xl';
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    colorScheme: 'dark',
    position: 'fixed',
});

const page = usePage();
const sidebar = useSidebar();

onMounted(() => {
    sidebar.setOpen(page.props.sidebarOpen);
});
</script>

<template>
    <CSidebar
        data-slot="sidebar"
        v-bind="props"
        :class="cn('border-end', props.class)"
        :unfoldable="sidebar.openMobile"
        :visible="sidebar.open"
        @visible-change="(value) => sidebar.setOpen(value)"
    >
        <slot/>
    </CSidebar>
</template>
