<script setup lang="ts">
import { CToaster } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import Icon from '@/components/Icon.vue';
import {
    Toast,
    ToastContent,
    ToastHeader,
    resolveToastIcon,
} from '@/components/ui/toast';
import { dismissToast, toasts } from '@/composables/useFlashToast';
import { cn } from '@/lib/utils';
import type { CToasterPlacement } from '@/types';

type Props = {
    placement?: CToasterPlacement;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    placement: 'bottom-end',
});

const delegatedProps = reactiveOmit(props, 'class');

const page = usePage();
const name = page.props.name;
</script>

<template>
    <CToaster
        data-slot="toaster"
        v-bind="delegatedProps"
        :class="cn('p-3', props.class)"
    >
        <Toast
            v-for="toast in toasts"
            :key="toast.id"
            class="rounded-4 shadow-sm"
            autohide
            :delay="4000"
            visible
            @close="dismissToast(toast.id)"
        >
            <ToastHeader class="align-items-center rounded-top-4">
                <strong class="fw-light text-truncate">{{ name }}</strong>
                <time
                    class="fw-medium small ms-auto"
                    :datetime="toast.created_at.toISOString()"
                >
                    {{ toast.created_at.toLocaleTimeString() }}
                </time>
            </ToastHeader>
            <ToastContent class="d-flex align-items-center gap-2">
                <Icon v-bind="resolveToastIcon(toast.type)" />
                {{ toast.message }}
            </ToastContent>
        </Toast>
    </CToaster>
</template>
