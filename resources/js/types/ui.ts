export * from './coreui';

import type { BreadcrumbItem } from './navigation';

export type Appearance = 'light' | 'dark' | 'system';
export type ResolvedAppearance = 'light' | 'dark';

export type AppBreadcrumbProps = {
    breadcrumbs?: BreadcrumbItem[];
};
export type AppShellVariant = 'header' | 'sidebar';

export type TableColumn = {
    key: string;
    label?: string;
    [key: string]: unknown;
};
