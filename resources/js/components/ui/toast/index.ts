import { cilCheckCircle, cilWarning } from '@coreui/icons';
import { CIcon, CIconSvg } from '@coreui/icons-vue';
import { biExclamationCircle, biInfoCircle } from '@/components/icon';
export { default as Toast } from './Toast.vue';
export { default as ToastContent } from './ToastContent.vue';
export { default as Toaster } from './Toaster.vue';
export { default as ToastHeader } from './ToastHeader.vue';

export const toastIcons = {
    success: {
        component: CIcon,
        props: { icon: cilCheckCircle },
        slot: null,
        class: 'text-success',
    },
    warning: {
        component: CIcon,
        props: { icon: cilWarning },
        slot: null,
        class: 'text-warning',
    },
    info: {
        component: CIconSvg,
        props: {},
        slot: biInfoCircle,
        class: 'text-info',
    },
    error: {
        component: CIconSvg,
        props: {},
        slot: biExclamationCircle,
        class: 'text-danger',
    },
} as const;
