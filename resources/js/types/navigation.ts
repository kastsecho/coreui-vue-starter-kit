import type { InertiaLinkProps } from '@inertiajs/vue3';

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: string;
    isActive?: boolean;
};

export type PaginationItem = {
    url?: string;
    label: string;
    page?: number;
    active: boolean;
};

export type PaginationMeta = {
    current_page: number;
    last_page: number;
    from: number;
    path: string;
    to: number;
    total: number;
    links: PaginationItem[];
};
