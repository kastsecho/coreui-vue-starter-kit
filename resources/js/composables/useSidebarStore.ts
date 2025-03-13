import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useSidebarStore = defineStore('sidebar', () => {
    const visible = ref<boolean | undefined>(undefined);
    const unfoldable = ref<boolean>(false);

    const toggleVisible = (value?: boolean) => {
        visible.value = value !== undefined ? value : !visible.value;
    };

    const toggleUnfoldable = () => {
        unfoldable.value = !unfoldable.value;
    };

    return { visible, unfoldable, toggleVisible, toggleUnfoldable };
});
