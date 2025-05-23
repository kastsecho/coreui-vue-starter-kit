<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { PinInput } from '@/components/ui/pin';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import {
    CBadge,
    CButton,
    CCard,
    CCardBody,
    CCardFooter,
    CCardHeader,
    CCardText,
    CCardTitle,
    CFormInput,
    CInputGroup,
    CModal,
    CModalBody,
    CModalHeader,
    CModalTitle,
    CSpinner,
} from '@coreui/vue';
import { Head } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = withDefaults(
    defineProps<{
        confirmed?: boolean;
        recoveryCodes?: string[];
    }>(),
    {
        confirmed: false,
        recoveryCodes: () => [],
    },
);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Two-Factor Authentication',
        href: '/settings/two-factor',
    },
];

const {
    confirmed,
    qrCodeSvg,
    secretKey,
    recoveryCodesList,
    copied,
    passcode,
    error,
    verifyStep,
    showingRecoveryCodes,
    showModal,
    confirm,
    regenerateRecoveryCodes,
    disable,
    reset,
    closeModal,
    copyToClipboard,
} = useTwoFactorAuth(props.confirmed, props.recoveryCodes);

const pinComplete = (value: string[]) => {
    passcode.value = value.join('');
    confirm();
};

watch(
    () => passcode.value,
    (newValue: string) => {
        if (newValue && error.value) {
            error.value = '';
        }
    },
);

// Toggle recovery codes visibility
const toggleRecoveryCodes = () => {
    showingRecoveryCodes.value = !showingRecoveryCodes.value;
};
</script>

<template>
    <AppLayout :breadcrumbs>
        <Head title="Two-Factor Authentication" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall title="Two-Factor Authentication" description="Manage your two-factor authentication settings" />

                <div v-if="!confirmed" class="d-flex flex-column align-items-start justify-content-start row-gap-3">
                    <CBadge color="danger">Disabled</CBadge>

                    <p class="my-n1">
                        When you enable 2FA, you'll be prompted for a secure code during login, which can be retrieved from your phone's Google
                        Authenticator app.
                    </p>

                    <CButton color="primary" @click="showModal = true">Enable</CButton>

                    <CModal :visible="showModal" teleport @close="closeModal">
                        <CModalHeader>
                            <CModalTitle>
                                <template v-if="!verifyStep">Turn on 2-step Verification</template>
                                <template v-else>Verify Authentication Code</template>
                            </CModalTitle>
                        </CModalHeader>

                        <CModalBody>
                            <p class="text-center">
                                <template v-if="!verifyStep">Open your authenticator app and choose Scan QR code.</template>
                                <template v-else>Enter the 6-digit code from your authenticator app</template>
                            </p>

                            <div class="d-flex flex-column align-items-center justify-content-center row-gap-3">
                                <template v-if="!verifyStep">
                                    <div>
                                        <CSpinner v-if="!qrCodeSvg" class="size-5" />
                                        <div v-else class="img-thumbnail bg-white border-2 border-secondary-subtle" v-html="qrCodeSvg" />
                                    </div>

                                    <div class="w-100">
                                        <CButton class="w-100" color="primary" @click="verifyStep = true">Continue</CButton>
                                    </div>

                                    <span class="px-2 py-1">or, enter the code manually</span>

                                    <CSpinner v-if="!secretKey" class="size-5" />
                                    <CInputGroup v-else>
                                        <CFormInput v-model="secretKey" class="border-secondary-subtle" type="text" disabled />
                                        <CButton color="light" @click="copyToClipboard(secretKey)">
                                            <span v-if="copied" class="bi-check fw-semibold text-success" />
                                            <span v-else class="bi-copy fw-semibold" />
                                        </CButton>
                                    </CInputGroup>
                                </template>

                                <template v-else>
                                    <PinInput v-model="passcode" :length="6" :invalid="!!error" @complete="pinComplete" />

                                    <InputError v-if="error" :class="{ 'd-block text-center': error }" :message="error" />

                                    <div class="w-100 d-flex gap-3">
                                        <CButton color="light" class="w-auto flex-grow-1" @click="reset">Back</CButton>
                                        <CButton
                                            color="primary"
                                            class="w-auto flex-grow-1"
                                            @click="confirm"
                                            :disabled="!passcode || passcode.length < 6"
                                        >
                                            Confirm
                                        </CButton>
                                    </div>
                                </template>
                            </div>
                        </CModalBody>
                    </CModal>
                </div>

                <div v-if="confirmed" class="d-flex flex-column align-items-start justify-content-start row-gap-3">
                    <CBadge color="success">Enabled</CBadge>

                    <p class="my-n1">
                        With two factor authentication enabled, you'll be prompted for a secure, random token during login, which you can retrieve
                        from your Google Authenticator app.
                    </p>

                    <CCard class="w-100 shadow-sm">
                        <CCardHeader class="d-flex">
                            <span class="bi-lock me-2"></span>

                            <div>
                                <CCardTitle>2FA Recovery Codes</CCardTitle>

                                <CCardText class="text-muted">
                                    Recovery codes let you regain access if you lose your 2FA device. Store them in a secure password manager.
                                </CCardText>
                            </div>
                        </CCardHeader>
                        <CCardFooter>
                            <div class="d-flex justify-content-between">
                                <CButton color="secondary" size="sm" variant="ghost" @click="toggleRecoveryCodes">
                                    <template v-if="showingRecoveryCodes">
                                        <span class="bi-eye-slash me-1" />
                                        Hide Recovery Codes
                                    </template>
                                    <template v-else>
                                        <span class="bi-eye me-1" />
                                        View My Recovery Codes
                                    </template>
                                </CButton>

                                <CButton v-if="showingRecoveryCodes" color="light" size="sm" @click="regenerateRecoveryCodes">
                                    Regenerate Codes
                                </CButton>
                            </div>
                        </CCardFooter>
                        <CCardBody v-if="showingRecoveryCodes" class="d-grid g ap-3">
                            <CCardText class="px-4 d-grid">
                                <code v-for="(code, index) in recoveryCodesList" :key="index" v-text="code" />
                            </CCardText>

                            <CCardText class="px-4 text-muted">
                                You have {{ recoveryCodesList.length }} recovery codes left. Each can be used once to access your account and will be
                                removed after use. If you need more, click
                                <span class="fw-bold text-decoration-underline">Regenerate Codes</span> above.
                            </CCardText>
                        </CCardBody>
                    </CCard>

                    <CButton color="danger" @click="disable">Disable 2FA</CButton>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
