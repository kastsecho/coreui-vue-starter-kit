import { InertiaLinkProps } from '@inertiajs/vue3';
import type { ComputedRef, Ref } from 'vue';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
}

export interface ColumnItem {
    key: string;
    label?: string;
    placeholder?: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: string;
    isActive?: boolean;
}

export interface Sidebar {
    state: ComputedRef<'expanded' | 'collapsed'>;
    open: Ref<boolean>;
    setOpen: (value: boolean) => void;
    toggleOpen: () => void;
    isMobile: Ref<boolean>;
    openMobile: Ref<boolean>;
    toggleOpenMobile: () => void;
    setOpenMobile: (value: boolean) => void;
    toggleSidebar: () => void;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}
