import type { PaginationItem, PaginationMeta } from '@/types/navigation';

export interface ApiModel<
    TAttributes extends { id?: unknown },
    TMeta = Record<string, unknown>,
    TLinks = Record<string, unknown>,
> {
    id: string;
    type: string;
    attributes: Omit<TAttributes, 'id'>;
    meta?: TMeta;
    links?: TLinks;
}

export interface ApiResource<
    TAttributes extends { id?: unknown },
    TMeta = Record<string, unknown>,
    TLinks = Record<string, unknown>,
> {
    data: ApiModel<TAttributes, TMeta, TLinks>;
}

export interface ApiCollection<
    TAttributes extends { id?: unknown },
    TMeta = Record<string, unknown>,
    TLinks = Record<string, unknown>,
> {
    data: ApiModel<TAttributes, TMeta, TLinks>[];
    meta?: PaginationMeta;
    links?: PaginationItem[];
}
