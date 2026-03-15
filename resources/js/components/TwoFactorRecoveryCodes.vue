<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { nextTick, onMounted, ref, useTemplateRef } from 'vue';
import AlertError from '@/components/AlertError.vue';
import Icon from '@/components/Icon.vue';
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
    <Card class="rounded-4">
        <CardHeader class="rounded-top-4">
            <CardTitle class="d-flex gap-3">
                <Icon name="lock-fill" />
                2FA recovery codes
            </CardTitle>
            <CardDescription>
                Recovery codes let you regain access if you lose your 2FA
                device. Store them in a secure password manager.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div
                class="d-flex flex-column gap-3 flex-sm-row align-items-sm-center justify-content-sm-between"
            >
                <Button @click="toggleRecoveryCodesVisibility">
                    <Icon
                        :name="
                            isRecoveryCodesVisible
                                ? 'eye-slash-fill'
                                : 'eye-fill'
                        "
                    />
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
                        color="secondary"
                        type="submit"
                        :disabled="processing"
                    >
                        <Icon name="arrow-clockwise" />
                        Regenerate codes
                    </Button>
                </Form>
            </div>
            <div v-if="isRecoveryCodesVisible">
                <div v-if="errors?.length" class="mt-3">
                    <AlertError :errors="errors" />
                </div>
                <div v-else class="mt-3 d-grid gap-3">
                    <div
                        ref="recoveryCodeSectionRef"
                        class="d-grid gap-1 rounded-4 bg-body-tertiary p-3 img-thumbnail"
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
                    <CardDescription class="small text-muted">
                        Each recovery code can be used once to access your
                        account and will be removed after use. If you need more,
                        click
                        <span class="fw-bold text-decoration-underline">
                            Regenerate codes
                        </span>
                        above.
                    </CardDescription>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
