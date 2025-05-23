import { useMediaQuery } from '@vueuse/core';
import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import type { Sidebar } from '@/types';

export const SIDEBAR_COOKIE_NAME = 'sidebar_state';
export const SIDEBAR_COOKIE_MAX_AGE = 60 * 60 * 24 * 7;

export const useSidebar = defineStore('Sidebar', (): Sidebar => {
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
        toggleOpen,
        isMobile,
        openMobile,
        setOpenMobile,
        toggleOpenMobile,
        toggleSidebar,
    };
});
