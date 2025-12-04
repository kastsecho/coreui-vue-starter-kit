export { default as Pagination } from './Pagination.vue';
export { default as PaginationLink } from './PaginationLink.vue';
export { default as PaginationPage } from './PaginationPage.vue';

export interface PaginationItem {
    url?: string;
    label: string;
    page?: number;
    active: boolean;
}

export interface Meta {
    current_page: number;
    last_page: number;
    from: number;
    path: string;
    to: number;
    total: number;
    links: PaginationItem[];
}
