import { useMediaQuery } from '@vueuse/core';
import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import type { ComputedRef, Ref } from 'vue';

export type SidebarContext = {
    state: ComputedRef<'expanded' | 'collapsed'>;
    open: Ref<boolean>;
    setOpen: (value: boolean) => void;
    isMobile: Ref<boolean>;
    openMobile: Ref<boolean>;
    setOpenMobile: (value: boolean) => void;
    toggleSidebar: () => void;
};

export const SIDEBAR_COOKIE_NAME = 'sidebar_state';
export const SIDEBAR_COOKIE_MAX_AGE = 60 * 60 * 24 * 7;
export const SIDEBAR_WIDTH = '16rem';
export const SIDEBAR_WIDTH_MOBILE = '18rem';
export const SIDEBAR_WIDTH_ICON = '3rem';
export const SIDEBAR_KEYBOARD_SHORTCUT = 'b';

export const useSidebar = defineStore('Sidebar', (): SidebarContext => {
    const isMobile = useMediaQuery('(max-width: 768px)');
    const open = ref<boolean>(true);
    const openMobile = ref<boolean>(false);
    const state = computed(() => open.value ? 'expanded' : 'collapsed');

    const setOpen = (value: boolean) => {
        open.value = value;

        document.cookie = `${SIDEBAR_COOKIE_NAME}=${open.value}; path=/; max-age=${SIDEBAR_COOKIE_MAX_AGE}`;
    };

    const toggleOpen = () => {
        setOpen(!open.value);
    };

    const setOpenMobile = (value: boolean) => {
        openMobile.value = value;
    };

    const toggleOpenMobile = () => {
        setOpenMobile(!openMobile.value);
    };

    const toggleSidebar = () => {
        return isMobile.value ? toggleOpenMobile() : toggleOpen();
    };

    return {
        state,
        open,
        setOpen,
        isMobile,
        openMobile,
        setOpenMobile,
        toggleSidebar,
    };
});
