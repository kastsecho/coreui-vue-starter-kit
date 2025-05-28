import type { PageProps } from '@inertiajs/core';
import type { ComputedRef, Ref } from 'vue';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
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

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}
