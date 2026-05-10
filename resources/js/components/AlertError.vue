<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { computed } from 'vue';
import { biExclamationCircle } from '@/components/icon';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';

type Props = {
    errors: string[];
    title?: string;
};

const props = withDefaults(defineProps<Props>(), {
    title: 'Something went wrong.',
});

const uniqueErrors = computed(() => Array.from(new Set(props.errors)));
</script>

<template>
    <Alert color="danger">
        <div class="d-flex align-items-center gap-3">
            <CIconSvg class="text-danger">
                <biExclamationCircle class="icon icon-lg" />
            </CIconSvg>
            <AlertTitle as="h5" class="mb-0">{{ title }}</AlertTitle>
        </div>
        <AlertDescription>
            <ul class="mb-0">
                <li v-for="(error, index) in uniqueErrors" :key="index">
                    {{ error }}
                </li>
            </ul>
        </AlertDescription>
    </Alert>
</template>
