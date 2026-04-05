import { router } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';
import type { FlashToast } from '@/types/ui';

export const toasts = ref<FlashToast[]>([]);

let nextId = 0;

export const dismissToast = (id: number) => {
    toasts.value = toasts.value.filter((toast) => toast.id !== id);
};

export const addToast = (
    message: string,
    type: FlashToast['type'] = 'success',
) => {
    const id = nextId++;
    const created_at = new Date();
    toasts.value.push({ id, message, type, created_at });
};

export function useFlashToast() {
    let removeListener: (() => void) | null = null;

    onMounted(() => {
        removeListener = router.on('flash', (event) => {
            const flash = (event as CustomEvent).detail?.flash;
            const data = flash?.toast as FlashToast | undefined;

            if (!data) {
                return;
            }

            addToast(data.message, data.type);
        });
    });

    onUnmounted(() => {
        removeListener?.();
    });
}
