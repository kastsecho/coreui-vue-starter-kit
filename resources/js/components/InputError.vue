<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <span v-if="message" class="invalid-feedback" role="alert">
        <strong>{{ message }}</strong>
    </span>
</template>
