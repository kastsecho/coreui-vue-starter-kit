<script setup lang="ts">
import { cn, toUrl } from '@/lib/utils';
import { CBreadcrumbItem } from '@coreui/vue';
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
    <Link
        v-if="as != 'a'"
        data-slot="breadcrumb-link"
        v-bind="props"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'breadcrumb-item link-body-emphasis', props.class)"
    >
        <slot/>
    </Link>
    <CBreadcrumbItem
        v-else
        data-slot="breadcrumb-link"
        :class="props.class"
        :href="href"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CBreadcrumbItem>
</template>
