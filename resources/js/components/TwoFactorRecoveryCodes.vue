<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { regenerateRecoveryCodes } from '@/routes/two-factor';
import { Form } from '@inertiajs/vue3';
import { nextTick, onMounted, ref } from 'vue';

const { recoveryCodesList, fetchRecoveryCodes } = useTwoFactorAuth();
const isRecoveryCodesVisible = ref<boolean>(false);
const recoveryCodeSectionRef = ref<HTMLDivElement | null>(null);

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
            <CardTitle class="d-flex gap-3">
                <Icon name="lock-fill" />
                2FA Recovery Codes
            </CardTitle>
            <CardDescription>
                Recovery codes let you regain access if you lose your 2FA device. Store them in a secure password manager.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div class="d-flex flex-column gap-3 flex-sm-row align-items-sm-center justify-content-sm-between">
                <Button @click="toggleRecoveryCodesVisibility" class="w-fit">
                    <Icon :name="isRecoveryCodesVisible ? 'eye-slash-fill' : 'eye-fill'" />
                    {{ isRecoveryCodesVisible ? 'Hide' : 'View' }} Recovery Codes
                </Button>

                <Form
                    v-if="isRecoveryCodesVisible"
                    v-bind="regenerateRecoveryCodes.form()"
                    method="post"
                    :options="{ preserveScroll: true }"
                    @success="fetchRecoveryCodes"
                    #default="{ processing }"
                >
                    <Button color="secondary" type="submit" :disabled="processing">
                        <Icon name="arrow-clockwise" />
                        Regenerate Codes
                    </Button>
                </Form>
            </div>
            <div :class="['relative overflow-hidden transition-all duration-300', isRecoveryCodesVisible ?
            'h-100 opacity-100' : 'opacity-0']">
                <div class="mt-3 d-grid gap-3">
                    <div ref="recoveryCodeSectionRef" class="d-grid gap-1 rounded-4 bg-body-tertiary p-3 img-thumbnail">
                        <template v-if="!recoveryCodesList.length">
                            <Spinner v-for="n in 8" :key="n" size="sm" />
                        </template>
                        <code v-else v-for="(code, index) in recoveryCodesList" :key="index" class="fw-medium">
                            {{ code }}
                        </code>
                    </div>
                    <CardDescription class="text-muted">
                        Each recovery code can be used once to access your account and will be removed after use. If
                        you need more, click <span class="fw-bold text-body-emphasis">Regenerate Codes</span> above.
                    </CardDescription>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
