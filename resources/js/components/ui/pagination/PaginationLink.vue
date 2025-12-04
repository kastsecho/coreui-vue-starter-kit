<script setup lang="ts">
import { cn, toUrl } from '@/lib/utils';
import { CPaginationItem } from '@coreui/vue';
import { type InertiaLinkProps, Link } from '@inertiajs/vue3';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<InertiaLinkProps & {
    active?: boolean;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();

const href = computed(() => toUrl(props.href ? props.href : ''));
</script>

<template>
    <li v-if="as != 'a'" class="page-item">
        <Link
            v-if="as != 'a'"
            data-slot="pagination-link"
            v-bind="props"
            :class="cn({
                ['active']: active,
                ['disabled']: disabled,
            }, 'page-link', props.class)"
        >
            <slot/>
        </Link>
    </li>
    <CPaginationItem
        v-else
        data-slot="pagination-link"
        :class="props.class"
        :href="href"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CPaginationItem>
</template>
