<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { computed } from 'vue';

interface Props {
    errors: string[];
    title?: string;
}

const props = withDefaults(defineProps<Props>(), {
    title: 'Something went wrong.',
});

const uniqueErrors = computed(() => Array.from(new Set(props.errors)));
</script>

<template>
    <Alert color="dark">
        <Icon class="size-5 text-danger" name="exclamation-circle-fill" />
        <AlertTitle>{{ title }}</AlertTitle>
        <AlertDescription>
            <ul>
                <li v-for="(error, index) in uniqueErrors" :key="index">
                    {{ error }}
                </li>
            </ul>
        </AlertDescription>
    </Alert>
</template>
