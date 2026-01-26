<script setup lang="ts">
import { CSidebar } from '@coreui/vue';
import { defaultDocument, reactiveOmit } from "@vueuse/core"
import { onMounted } from 'vue';
import { cn } from '@/lib/utils';
import { type SidebarProps } from '.';
import { SIDEBAR_COOKIE_NAME, useSidebar } from './utils';

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
});
</script>

<template>
    <CSidebar
        data-slot="sidebar"
        v-bind="delegatedProps"
        :class="cn('border-end', props.class)"
        :unfoldable="sidebar.openMobile"
        :visible="sidebar.open"
        @visible-change="(value) => sidebar.setOpen(value)"
    >
        <slot />
    </CSidebar>
</template>
