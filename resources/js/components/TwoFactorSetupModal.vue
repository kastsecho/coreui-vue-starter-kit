<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { Form } from '@inertiajs/vue3';
import { useClipboard } from '@vueuse/core';
import { computed, nextTick, ref, useTemplateRef, watch } from 'vue';
import AlertError from '@/components/AlertError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input, InputFeedback, InputGroup } from '@/components/ui/form';
import {
    InputOTP,
    InputOTPGroup,
    InputOTPSlot,
} from '@/components/ui/input-otp';
import { Separator } from '@/components/ui/separator';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { cilBarcode, cilCheck, cilCopy } from '@/icons';
import { confirm } from '@/routes/two-factor';
import type { TwoFactorConfigContent } from '@/types';

const props = defineProps<{
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
}>();
const isOpen = defineModel<boolean>('isOpen');

const { copy, copied } = useClipboard();
const { qrCodeSvg, manualSetupKey, clearSetupData, fetchSetupData, errors } =
    useTwoFactorAuth();

const showVerificationStep = ref(false);
const code = ref<string>('');

const pinInputContainerRef = useTemplateRef('pinInputContainerRef');

const modalConfig = computed<TwoFactorConfigContent>(() => {
    if (props.twoFactorEnabled) {
        return {
            title: 'Two-factor authentication enabled',
            description:
                'Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.',
            buttonText: 'Close',
        };
    }

    if (showVerificationStep.value) {
        return {
            title: 'Verify authentication code',
            description: 'Enter the 6-digit code from your authenticator app',
            buttonText: 'Continue',
        };
    }

    return {
        title: 'Enable two-factor authentication',
        description:
            'To finish enabling two-factor authentication, scan the QR code or enter the setup key in your authenticator app',
        buttonText: 'Continue',
    };
});

const handleModalNextStep = () => {
    if (props.requiresConfirmation) {
        showVerificationStep.value = true;

        nextTick(() => {
            pinInputContainerRef.value?.querySelector('input')?.focus();
        });

        return;
    }

    clearSetupData();
    isOpen.value = false;
};

const resetModalState = () => {
    if (props.twoFactorEnabled) {
        clearSetupData();
    }

    showVerificationStep.value = false;
    code.value = '';
};

watch(
    () => isOpen.value,
    async (isOpen) => {
        if (!isOpen) {
            resetModalState();

            return;
        }

        if (!qrCodeSvg.value) {
            await fetchSetupData();
        }
    },
);
</script>

<template>
    <Dialog
        content-class-name="rounded-4"
        :open="isOpen"
        @close="isOpen = false"
    >
        <DialogHeader
            class="d-flex flex-column align-items-center justify-content-center gap-2"
            :close-button="false"
        >
            <CIcon :icon="cilBarcode" size="xl" />
            <DialogTitle>{{ modalConfig.title }}</DialogTitle>
            <DialogDescription class="text-center" text-color="secondary">
                {{ modalConfig.description }}
            </DialogDescription>
        </DialogHeader>

        <DialogContent class="overflow-hidden sm:max-w-md">
            <div
                class="d-flex flex-column align-items-center justify-content-center gap-3"
            >
                <template v-if="!showVerificationStep">
                    <AlertError
                        v-if="errors?.length"
                        class="w-100"
                        :errors="errors"
                    />
                    <template v-else>
                        <div class="d-flex align-items-center overflow-hidden">
                            <div
                                v-if="!qrCodeSvg"
                                class="img-thumbnail bg-transparent"
                            >
                                <Spinner />
                            </div>
                            <div v-else class="img-thumbnail bg-light">
                                <div v-html="qrCodeSvg" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center w-100 gap-3">
                            <Button class="w-100" @click="handleModalNextStep">
                                {{ modalConfig.buttonText }}
                            </Button>
                        </div>

                        <Separator>or, enter the code manually</Separator>

                        <div
                            class="d-flex align-items-center justify-content-center w-100"
                        >
                            <div
                                v-if="!manualSetupKey"
                                class="d-flex align-items-center justify-content-center bg-transparent p-2"
                            >
                                <Spinner />
                            </div>
                            <template v-else>
                                <InputGroup>
                                    <Input
                                        type="text"
                                        :value="manualSetupKey"
                                        disabled
                                    />
                                    <Button
                                        type="button"
                                        color="light"
                                        @click="copy(manualSetupKey || '')"
                                    >
                                        <CIcon
                                            v-if="copied"
                                            :icon="cilCheck"
                                            class="text-success"
                                        />
                                        <CIcon v-else :icon="cilCopy" />
                                    </Button>
                                </InputGroup>
                            </template>
                        </div>
                    </template>
                </template>

                <template v-else>
                    <Form
                        v-bind="confirm.form()"
                        error-bag="confirmTwoFactorAuthentication"
                        reset-on-error
                        @finish="code = ''"
                        @success="isOpen = false"
                        v-slot="{ errors, processing }"
                        class="d-flex flex-column align-items-center row-gap-3"
                    >
                        <input type="hidden" name="code" :value="code" />
                        <div ref="pinInputContainerRef" class="d-grid">
                            <InputOTP
                                id="otp"
                                v-model="code"
                                :maxlength="6"
                                :disabled="processing"
                                autofocus
                            >
                                <InputOTPGroup
                                    :class="{ ['is-invalid']: errors?.code }"
                                >
                                    <InputOTPSlot
                                        v-for="index in 6"
                                        :key="index"
                                        color="body-tertiary"
                                        :index="index - 1"
                                    />
                                </InputOTPGroup>
                                <InputFeedback
                                    :message="errors?.code"
                                    invalid
                                />
                            </InputOTP>
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-center w-75 gap-3"
                        >
                            <Button
                                type="button"
                                color="light"
                                variant="outline"
                                class="flex-grow-1"
                                @click="showVerificationStep = false"
                                :disabled="processing"
                            >
                                Back
                            </Button>
                            <Button
                                type="submit"
                                class="flex-grow-1"
                                :disabled="processing || code.length < 6"
                            >
                                Confirm
                            </Button>
                        </div>
                    </Form>
                </template>
            </div>
        </DialogContent>
    </Dialog>
</template>
