<script setup lang="ts">
import { cn, toUrl } from '@/lib/utils';
import { CNavLink } from '@coreui/vue';
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
        data-slot="navigation-menu-link"
        v-bind="props"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'nav-link', props.class)"
    >
        <slot/>
    </Link>
    <CNavLink
        v-else
        data-slot="navigation-menu-link"
        as="a"
        :class="props.class"
        :href="href"
        :active="active"
        :disabled="disabled"
    >
        <slot/>
    </CNavLink>
</template>
