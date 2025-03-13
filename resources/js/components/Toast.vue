<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import type { SharedData } from '@/types';
import { CToast, CToastBody, CToastHeader } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';

const emit = defineEmits(['close']);

interface Props {
    autohide?: boolean;
    visible?: boolean;
    class?: string;
}

withDefaults(defineProps<Props>(), {
    autohide: true,
    visible: true,
});

const page = usePage<SharedData>();
</script>

<template>
    <CToast :visible :autohide @close="$emit('close')">
        <CToastHeader :close-button="!autohide" class="gap-3">
            <AppLogoIcon class="size-5 text-danger" />
            <strong class="me-auto">{{ page.props.name }}</strong>
        </CToastHeader>

        <CToastBody :class>
            <slot />
        </CToastBody>
    </CToast>
</template>
