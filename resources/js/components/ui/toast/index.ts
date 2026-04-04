import type { FlashToast } from '@/types';

export { default as Toast } from './Toast.vue';
export { default as ToastContent } from './ToastContent.vue';
export { default as Toaster } from './Toaster.vue';
export { default as ToastHeader } from './ToastHeader.vue';

export const toastIcons = {
    success: { name: 'check-circle-fill', color: 'success' },
    info: { name: 'info-circle-fill', color: 'info' },
    warning: { name: 'exclamation-triangle-fill', color: 'warning' },
    danger: { name: 'exclamation-circle-fill', color: 'danger' },
} as const;

export const resolveToastIcon = (type?: FlashToast['type']) => {
    return toastIcons[type ?? 'success'] ?? toastIcons.success;
};
