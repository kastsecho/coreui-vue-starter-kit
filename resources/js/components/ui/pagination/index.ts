import { computed } from 'vue';
import { type PaginationMeta } from '@/types';

export { default as Pagination } from './Pagination.vue';
export { default as PaginationLink } from './PaginationLink.vue';
export { default as PaginationPage } from './PaginationPage.vue';

export function usePagination(meta: PaginationMeta) {
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
