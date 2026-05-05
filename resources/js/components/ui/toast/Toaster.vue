<script setup lang="ts">
import { CToaster } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import {
    Toast,
    ToastContent,
    ToastHeader,
    toastIcons,
} from '@/components/ui/toast';
import { dismissToast, toasts } from '@/composables/useFlashToast';
import { cn } from '@/lib/utils';
import type { FlashToast } from '@/types';

type Placements =
    | 'top-start'
    | 'top-center'
    | 'top-end'
    | 'middle-start'
    | 'middle-center'
    | 'middle-end'
    | 'bottom-start'
    | 'bottom-center'
    | 'bottom-end';

type Props = {
    placement?: Placements;
    contentClassName?: HTMLAttributes['class'];
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    placement: 'bottom-end',
});

const delegatedProps = reactiveOmit(props, 'class');

const page = usePage();
const name = page.props.name;

const resolveIcon = (type: FlashToast['type']) => toastIcons[type ?? 'success'];
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
            autohide
            :class="contentClassName"
            :delay="4000"
            :index="toast.id"
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
                <component
                    :is="resolveIcon(toast.type).component"
                    v-bind="resolveIcon(toast.type).props"
                    :class="resolveIcon(toast.type).class"
                >
                    <component
                        v-if="resolveIcon(toast.type).slot"
                        :is="resolveIcon(toast.type).slot"
                    />
                </component>
                {{ toast.message }}
            </ToastContent>
        </Toast>
    </CToaster>
</template>
