export * from './coreui';

export type Appearance = 'light' | 'dark' | 'system';
export type ResolvedAppearance = 'light' | 'dark';

export type AppVariant = 'header' | 'sidebar';

export type FlashToast = {
    id: number;
    type: 'success' | 'info' | 'warning' | 'danger';
    message: string;
    created_at: Date;
};
