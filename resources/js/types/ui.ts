export * from './coreui';

export type Appearance = 'light' | 'dark' | 'system';
export type ResolvedAppearance = 'light' | 'dark';

export type AppShellVariant = 'header' | 'sidebar';

export type TableColumn = {
    key: string;
    label?: string;
    [key: string]: unknown;
};
