<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { CToaster } from '@coreui/vue';
</script>

<template>
    <AuthLayout>
        <slot />

        <CToaster placement="bottom-end" class="p-3">
            <slot name="toast" />
        </CToaster>
    </AuthLayout>
</template>
