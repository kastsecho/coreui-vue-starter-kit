export * from './coreui';

export type Appearance = 'light' | 'dark' | 'system';
export type ResolvedAppearance = 'light' | 'dark';

export type AppVariant = 'header';

export type FlashToast = {
    id: string;
    type: 'success' | 'info' | 'warning' | 'error';
    message: string;
    created_at: Date;
};
