<script setup lang="ts">
import { CIcon, CIconSvg } from '@coreui/icons-vue';
import { Form } from '@inertiajs/vue3';
import { nextTick, onMounted, ref, useTemplateRef } from 'vue';
import AlertError from '@/components/AlertError.vue';
import { biEye, biEyeSlash } from '@/components/icon';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { cilLockLocked, cilSync } from '@/icons';
import { regenerateRecoveryCodes } from '@/routes/two-factor';

const { recoveryCodesList, fetchRecoveryCodes, errors } = useTwoFactorAuth();
const isRecoveryCodesVisible = ref<boolean>(false);
const recoveryCodeSectionRef = useTemplateRef('recoveryCodeSectionRef');

const toggleRecoveryCodesVisibility = async () => {
    if (!isRecoveryCodesVisible.value && !recoveryCodesList.value.length) {
        await fetchRecoveryCodes();
    }

    isRecoveryCodesVisible.value = !isRecoveryCodesVisible.value;

    if (isRecoveryCodesVisible.value) {
        await nextTick();
        recoveryCodeSectionRef.value?.scrollIntoView({ behavior: 'smooth' });
    }
};

onMounted(async () => {
    if (!recoveryCodesList.value.length) {
        await fetchRecoveryCodes();
    }
});
</script>

<template>
    <Card class="rounded-4 shadow-sm">
        <CardHeader class="rounded-top-4">
            <CardTitle class="d-flex fw-semibold gap-3">
                <CIcon :icon="cilLockLocked" />
                2FA recovery codes
            </CardTitle>
            <CardDescription text-color="secondary">
                Recovery codes let you regain access if you lose your 2FA
                device. Store them in a secure password manager.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div
                class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3"
            >
                <Button @click="toggleRecoveryCodesVisibility">
                    <CIconSvg>
                        <component
                            :is="isRecoveryCodesVisible ? biEyeSlash : biEye"
                        />
                    </CIconSvg>
                    {{ isRecoveryCodesVisible ? 'Hide' : 'View' }} recovery
                    codes
                </Button>

                <Form
                    v-if="isRecoveryCodesVisible && recoveryCodesList.length"
                    v-bind="regenerateRecoveryCodes.form()"
                    method="post"
                    :options="{ preserveScroll: true }"
                    @success="fetchRecoveryCodes"
                    v-slot="{ processing }"
                >
                    <Button
                        type="submit"
                        color="secondary"
                        :disabled="processing"
                    >
                        <CIcon :icon="cilSync" />
                        Regenerate codes
                    </Button>
                </Form>
            </div>
            <div v-if="isRecoveryCodesVisible">
                <div v-if="errors?.length" class="mt-3">
                    <AlertError :errors="errors" />
                </div>
                <div v-else class="d-grid mt-3 gap-3">
                    <div
                        ref="recoveryCodeSectionRef"
                        class="d-grid rounded-4 bg-body-tertiary img-thumbnail gap-1 p-3"
                    >
                        <div v-if="!recoveryCodesList.length">
                            <Spinner v-for="n in 8" :key="n" />
                        </div>
                        <code
                            v-else
                            v-for="(code, index) in recoveryCodesList"
                            :key="index"
                            class="fw-medium"
                        >
                            {{ code }}
                        </code>
                    </div>
                    <CardDescription class="small" text-color="secondary">
                        Each recovery code can be used once to access your
                        account and will be removed after use. If you need more,
                        click
                        <span class="fw-bold text-body">Regenerate codes</span>
                        above.
                    </CardDescription>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
