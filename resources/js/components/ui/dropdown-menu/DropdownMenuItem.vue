<script setup lang="ts">
import { cn, toUrl } from '@/lib/utils';
import { CDropdownItem } from '@coreui/vue';
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
        data-slot="dropdown-menu-link"
        v-bind="props"
        :class="cn({
            ['active']: active,
            ['disabled']: disabled,
        }, 'dropdown-item', props.class)"
    >
        <slot/>
    </Link>
    <CDropdownItem
        v-else
        data-slot="dropdown-menu-link"
        as="a"
        :class="props.class"
        :href="href"
    >
        <slot/>
    </CDropdownItem>
</template>
