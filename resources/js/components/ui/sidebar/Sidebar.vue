<script setup lang="ts">
import { CSidebar } from '@coreui/vue';
import { defaultDocument, reactiveOmit, useEventListener } from '@vueuse/core';
import { onMounted } from 'vue';
import type { SidebarProps } from '@/components/ui/sidebar';
import {
    SIDEBAR_COOKIE_NAME,
    SIDEBAR_KEYBOARD_SHORTCUT,
    useSidebar,
} from '@/components/ui/sidebar/utils';
import { cn } from '@/lib/utils';

const props = withDefaults(defineProps<SidebarProps>(), {
    colorScheme: undefined,
    placement: undefined,
    position: 'fixed',
});

const visible = defineModel<boolean>('open', {
    default: !defaultDocument?.cookie.includes(`${SIDEBAR_COOKIE_NAME}=false`),
});

const delegatedProps = reactiveOmit(props, 'class');

const sidebar = useSidebar();

onMounted(() => {
    sidebar.setOpen(visible.value);

    useEventListener('keydown', (event: KeyboardEvent) => {
        if (
            event.key === SIDEBAR_KEYBOARD_SHORTCUT &&
            (event.metaKey || event.ctrlKey)
        ) {
            event.preventDefault();
            sidebar.toggleSidebar();
        }
    });
});
</script>

<template>
    <CSidebar
        data-slot="sidebar"
        data-sidebar="sidebar"
        v-bind="delegatedProps"
        :unfoldable="sidebar.narrow"
        :visible="sidebar.open"
        @visible-change="(value) => sidebar.setOpen(value)"
        :class="cn('border-end', props.class)"
    >
        <slot />
    </CSidebar>
</template>
