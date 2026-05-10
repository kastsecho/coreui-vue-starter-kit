import {
    cibGit,
    cilAccountLogout,
    cilApplications,
    cilBarcode,
    cilCheck,
    cilCheckCircle,
    cilCog,
    cilContrast,
    cilCopy,
    cilExternalLink,
    cilFlip,
    cilHamburgerMenu,
    cilHome,
    cilLockLocked,
    cilMoon,
    cilPeople,
    cilSpreadsheet,
    cilSun,
    cilSync,
    cilWarning,
    cilXCircle,
} from '@coreui/icons';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import { initializeTheme } from '@/composables/useAppearance';
import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const icons = {
    cibGit,
    cilAccountLogout,
    cilApplications,
    cilBarcode,
    cilCheck,
    cilCheckCircle,
    cilCog,
    cilContrast,
    cilCopy,
    cilExternalLink,
    cilFlip,
    cilHamburgerMenu,
    cilHome,
    cilLockLocked,
    cilMoon,
    cilPeople,
    cilSpreadsheet,
    cilSun,
    cilSync,
    cilWarning,
    cilXCircle,
};
const pinia = createPinia();

void createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
            case name === 'ErrorPage':
            case name === 'HealthPage':
                return null;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    withApp: (app) => {
        app.provide('icons', icons);
        app.use(pinia);
    },
    progress: {
        color: '#4B5563',
    },
});

initializeTheme();
