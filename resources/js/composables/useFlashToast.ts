import { router } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, useId } from 'vue';
import type { FlashToast } from '@/types';

export const toasts = ref<FlashToast[]>([]);

export const dismissToast = (id: FlashToast['id']) => {
    toasts.value = toasts.value.filter((toast) => toast.id !== id);
};

export const addToast = (
    message: string,
    type: FlashToast['type'] = 'success',
) => {
    const id = useId();
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
