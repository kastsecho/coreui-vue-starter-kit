<script setup lang="ts">
import { CSidebar } from '@coreui/vue';
import { defaultDocument, reactiveOmit, useEventListener } from "@vueuse/core"
import { onMounted } from 'vue';
import { cn } from '@/lib/utils';
import { type SidebarProps } from '.';
import { SIDEBAR_COOKIE_NAME, SIDEBAR_KEYBOARD_SHORTCUT, useSidebar } from './utils';

const sidebar = useSidebar();

const props = withDefaults(defineProps<SidebarProps>(), {
    colorScheme: 'dark',
    position: 'fixed',
});

const visible = defineModel<boolean>('open', {
    default: !defaultDocument?.cookie.includes(`${SIDEBAR_COOKIE_NAME}=false`)
});

const delegatedProps = reactiveOmit(props, 'class');

onMounted(() => {
    sidebar.setOpen(visible.value);

    useEventListener('keydown', (event: KeyboardEvent) => {
        if (event.key === SIDEBAR_KEYBOARD_SHORTCUT && (event.metaKey || event.ctrlKey)) {
            event.preventDefault()
            sidebar.toggleSidebar();
        }
    })
});
</script>

<template>
    <CSidebar
        data-slot="sidebar"
        data-sidebar="sidebar"
        v-bind="delegatedProps"
        :class="cn('border-end', props.class)"
        :unfoldable="sidebar.narrow"
        :visible="sidebar.open"
        @visible-change="(value) => sidebar.setOpen(value)"
    >
        <slot />
    </CSidebar>
</template>
