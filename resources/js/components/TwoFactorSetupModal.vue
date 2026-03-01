<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { useClipboard } from '@vueuse/core';
import { computed, ref, watch } from 'vue';
import AlertError from '@/components/AlertError.vue';
import Icon from '@/components/Icon.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input, InputError, InputGroup } from '@/components/ui/input';
import {
    InputOTP,
    InputOTPGroup,
    InputOTPSlot,
} from '@/components/ui/input-otp';
import { Separator } from '@/components/ui/separator';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { confirm } from '@/routes/two-factor';
import type { TwoFactorConfigContent } from '@/types';

type Props = {
    requiresConfirmation: boolean;
    twoFactorEnabled: boolean;
};

const props = defineProps<Props>();
const isOpen = defineModel<boolean>('isOpen');

const { copy, copied } = useClipboard();
const { qrCodeSvg, manualSetupKey, clearSetupData, fetchSetupData, errors } =
    useTwoFactorAuth();

const showVerificationStep = ref(false);
const code = ref<string>('');

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
        :open="isOpen"
        @update:open="isOpen = $event"
        @close="isOpen = false"
    >
        <DialogHeader
            class="d-flex flex-column align-items-center justify-content-center gap-2"
        >
            <Icon class="icon icon-xl" name="upc-scan" />
            <DialogTitle>{{ modalConfig.title }}</DialogTitle>
            <DialogDescription class="text-center">
                {{ modalConfig.description }}
            </DialogDescription>
        </DialogHeader>

        <DialogContent>
            <div
                class="d-flex flex-column align-items-center justify-content-center gap-3"
            >
                <template v-if="!showVerificationStep">
                    <AlertError
                        class="mb-0 w-100"
                        v-if="errors?.length"
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

                        <div class="d-flex w-100 align-items-center gap-3">
                            <Button class="w-100" @click="handleModalNextStep">
                                {{ modalConfig.buttonText }}
                            </Button>
                        </div>

                        <Separator>or, enter the code manually</Separator>

                        <div
                            class="w-100 d-flex align-items-center justify-content-center"
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
                                        <Icon
                                            v-if="copied"
                                            color="success"
                                            name="check"
                                        />
                                        <Icon v-else name="copy" />
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
                        class="d-flex flex-column align-items-center gap-3"
                    >
                        <input type="hidden" name="code" :value="code" />
                        <div class="d-grid">
                            <InputOTP
                                id="otp"
                                v-model="code"
                                :maxlength="6"
                                :disabled="processing"
                            >
                                <InputOTPGroup>
                                    <InputOTPSlot
                                        v-for="index in 6"
                                        :key="index"
                                        color="body-tertiary"
                                        :index="index - 1"
                                    />
                                </InputOTPGroup>
                            </InputOTP>
                            <InputError
                                :class="{ ['d-block']: errors?.code }"
                                :message="errors?.code"
                            />
                        </div>

                        <div
                            class="w-75 d-flex align-items-center justify-content-center gap-3"
                        >
                            <Button
                                type="button"
                                color="secondary"
                                class="flex-grow-1"
                                :disabled="processing"
                                @click="showVerificationStep = false"
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
