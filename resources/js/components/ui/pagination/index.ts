import { computed } from 'vue';

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

export function usePagination(meta: Meta) {
    const links = computed(() => meta.links ?? []);

    const hasPages = computed(() => meta.last_page > 1);

    const onFirstPage = computed(() => meta.current_page === 1);

    const previousPageUrl = computed(() => links.value[0]?.url ?? '');

    const hasMorePages = computed(() => meta.to < meta.total);

    const nextPageUrl = computed(() =>
        links.value[links.value.length - 1]?.url ?? ''
    );

    const elements = computed(() => links.value.slice(1, -1));

    return {
        hasPages,
        hasMorePages,
        nextPageUrl,
        onFirstPage,
        previousPageUrl,
        elements,
    };
}
