<script setup lang="ts">
import {
    Pagination,
    PaginationLink,
    PaginationPage,
    usePagination,
} from '@/components/ui/pagination';
import type { PaginationMeta } from '@/types';

const props = defineProps<{
    meta: PaginationMeta;
}>();

const {
    hasPages,
    onFirstPage,
    previousPageUrl,
    hasMorePages,
    nextPageUrl,
    elements,
} = usePagination(props.meta);
</script>

<template>
    <nav
        v-if="hasPages"
        class="d-flex justify-items-center justify-content-between"
    >
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <Pagination>
                <!-- Previous Page Link -->
                <PaginationPage v-if="onFirstPage" disabled>
                    &laquo; Previous
                </PaginationPage>
                <PaginationLink v-else :href="previousPageUrl" rel="prev">
                    &laquo; Previous
                </PaginationLink>

                <!-- Next Page Link -->
                <PaginationLink
                    v-if="hasMorePages"
                    :href="nextPageUrl"
                    rel="next"
                >
                    Next &raquo;
                </PaginationLink>
                <PaginationPage v-else disabled>Next &raquo;</PaginationPage>
            </Pagination>
        </div>

        <div
            class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between"
        >
            <p class="mb-0 flex-shrink-0 small text-muted">
                Showing
                <span class="fw-semibold" v-text="meta.from" />
                to
                <span class="fw-semibold" v-text="meta.to" />
                of
                <span class="fw-semibold" v-text="meta.total" />
                results.
            </p>

            <Pagination>
                <!-- Previous Page Link -->
                <PaginationPage v-if="onFirstPage" disabled>
                    &laquo; Previous
                </PaginationPage>
                <PaginationLink v-else :href="previousPageUrl" rel="prev">
                    &laquo; Previous
                </PaginationLink>

                <!-- Pagination Elements -->
                <template v-for="(element, index) in elements" :key="index">
                    <!-- "Three Dots" Separator -->
                    <PaginationPage v-if="!element.page" disabled>
                        {{ element.label }}
                    </PaginationPage>

                    <!-- Array Of Links -->
                    <PaginationPage v-else-if="element.active" active>
                        {{ element.label }}
                    </PaginationPage>
                    <PaginationLink v-else :href="element.url">
                        {{ element.label }}
                    </PaginationLink>
                </template>

                <!-- Next Page Link -->
                <PaginationLink
                    v-if="hasMorePages"
                    :href="nextPageUrl"
                    rel="next"
                >
                    Next &raquo;
                </PaginationLink>
                <PaginationPage v-else disabled>Next &raquo;</PaginationPage>
            </Pagination>
        </div>
    </nav>
</template>
