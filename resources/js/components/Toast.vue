<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {
    Toast,
    ToastContent,
    ToastGroup,
    ToastHeader,
} from '@/components/ui/toast';

const emit = defineEmits(['close']);

interface Props {
    autohide?: boolean;
    visible?: boolean;
}

withDefaults(defineProps<Props>(), {
    autohide: true,
    visible: true,
});

const page = usePage();

const closeToast = () => emit('close');
</script>

<template>
    <ToastGroup class="p-3" placement="bottom-end">
        <Toast :autohide="autohide" :visible="visible" @close="closeToast">
            <ToastHeader :close-button="!autohide" class="gap-3">
                <AppLogoIcon class="size-5 text-danger" />
                <strong class="me-auto">{{ page.props.name }}</strong>
            </ToastHeader>

            <ToastContent>
                <slot />
            </ToastContent>
        </Toast>
    </ToastGroup>
</template>
