import { useMediaQuery } from '@vueuse/core';
import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import type { ComputedRef, Ref } from 'vue';

export type SidebarContext = {
    state: ComputedRef<'expanded' | 'collapsed'>;
    open: Ref<boolean>;
    setOpen: (value: boolean) => void;
    isMobile: Ref<boolean>;
    narrow: Ref<boolean>;
    setNarrow: (value: boolean) => void;
    toggleCollapse: () => void;
    toggleSidebar: () => void;
};

export const SIDEBAR_COOKIE_NAME = 'sidebar_state';
export const SIDEBAR_COOKIE_MAX_AGE = 60 * 60 * 24 * 7;
export const SIDEBAR_KEYBOARD_SHORTCUT = 'b';

export const useSidebar = defineStore('Sidebar', (): SidebarContext => {
    const isMobile = useMediaQuery('(max-width: 768px)');
    const open = ref<boolean>(true);
    const narrow = ref<boolean>(false);
    const state = computed(() => open.value ? 'expanded' : 'collapsed');

    const setOpen = (value: boolean) => {
        open.value = value;

        document.cookie = `${SIDEBAR_COOKIE_NAME}=${open.value}; path=/; max-age=${SIDEBAR_COOKIE_MAX_AGE}`;
    };

    const setNarrow = (value: boolean) => {
        narrow.value = value;
    };

    const toggleCollapse = () => {
        return setNarrow(!narrow.value);
    };

    const toggleSidebar = () => {
        return setOpen(!open.value);
    };

    return {
        state,
        open,
        setOpen,
        isMobile,
        narrow,
        setNarrow,
        toggleCollapse,
        toggleSidebar,
    };
});
