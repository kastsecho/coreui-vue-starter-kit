import type { InertiaLinkProps } from '@inertiajs/vue3';
import { clsx } from 'clsx';
import type { ClassValue } from 'clsx';

export function cn(...inputs: ClassValue[]): string {
    return clsx(inputs);
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>): string {
    return typeof href === 'string' ? href : href?.url;
}
