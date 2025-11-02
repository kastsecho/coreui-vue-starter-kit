<script setup lang="ts">
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
    PinInput,
    PinInputGroup,
    PinInputSlot,
} from '@/components/ui/pin-input';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { confirm } from '@/routes/two-factor';
import { Form } from '@inertiajs/vue3';
import { useClipboard } from '@vueuse/core';
import { computed, nextTick, ref, watch } from 'vue';

interface Props {
    requiresConfirmation: boolean;
    twoFactorEnabled: boolean;
}

const props = defineProps<Props>();
const isOpen = defineModel<boolean>('isOpen');

const { copy, copied } = useClipboard();
const { qrCodeSvg, manualSetupKey, clearSetupData, fetchSetupData } =
    useTwoFactorAuth();

const showVerificationStep = ref(false);
const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join(''));

const pinInputContainerRef = ref<HTMLElement | null>(null);

const modalConfig = computed<{
    title: string;
    description: string;
    buttonText: string;
}>(() => {
    if (props.twoFactorEnabled) {
        return {
            title: 'Two-Factor Authentication Enabled',
            description:
                'Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.',
            buttonText: 'Close',
        };
    }

    if (showVerificationStep.value) {
        return {
            title: 'Verify Authentication Code',
            description: 'Enter the 6-digit code from your authenticator app',
            buttonText: 'Continue',
        };
    }

    return {
        title: 'Enable Two-Factor Authentication',
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
    code.value = [];
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
        @update:open="isOpen = $event"
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
                    <div class="d-flex align-items-center overflow-hidden">
                        <div
                            v-if="!qrCodeSvg"
                            class="img-thumbnail bg-transparent"
                        >
                            <Spinner size="sm" />
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

                    <div
                        class="d-flex w-100 align-items-center justify-content-center"
                    >
                        <hr class="flex-grow-1" />
                        <span class="px-2">or, enter the code manually</span>
                        <hr class="flex-grow-1" />
                    </div>

                    <div
                        class="w-100 d-flex align-items-center justify-content-center"
                    >
                        <div
                            v-if="!manualSetupKey"
                            class="d-flex align-items-center justify-content-center bg-transparent p-2"
                        >
                            <Spinner size="sm" />
                        </div>
                        <InputGroup v-else>
                            <Input
                                type="text"
                                disabled
                                :value="manualSetupKey"
                            />
                            <Button
                                type="button"
                                color="light"
                                @click="copy(manualSetupKey || '')"
                            >
                                <Icon
                                    v-if="copied"
                                    class="text-success"
                                    name="check"
                                />
                                <Icon v-else name="copy" />
                            </Button>
                        </InputGroup>
                    </div>
                </template>

                <template v-else>
                    <Form
                        v-bind="confirm.form()"
                        reset-on-error
                        @finish="code = []"
                        @success="isOpen = false"
                        v-slot="{ errors, processing }"
                    >
                        <input type="hidden" name="code" :value="codeValue" />
                        <div
                            ref="pinInputContainerRef"
                            class="d-flex flex-column align-items-center overflow-hidden gap-3"
                        >
                            <div class="d-grid">
                                <PinInput v-model="code" id="otp">
                                    <PinInputGroup>
                                        <PinInputSlot
                                            class="bg-body-tertiary text-center"
                                            autofocus
                                            v-for="(id, index) in 6"
                                            :key="id"
                                            :index="index"
                                            placeholder="○"
                                            :disabled="processing"
                                            @complete="
                                                (digit) => {
                                                    code[index] = digit;
                                                }
                                            "
                                        />
                                    </PinInputGroup>
                                </PinInput>
                                <InputError
                                    :class="{
                                        ['d-block']:
                                            errors
                                                ?.confirmTwoFactorAuthentication
                                                ?.code,
                                    }"
                                    :message="
                                        errors?.confirmTwoFactorAuthentication
                                            ?.code
                                    "
                                />
                            </div>

                            <div
                                class="w-50 d-flex align-items-center justify-content-center gap-3"
                            >
                                <Button
                                    type="button"
                                    color="light"
                                    class="flex-grow-1"
                                    @click="showVerificationStep = false"
                                    :tabindex="7"
                                    :disabled="processing"
                                >
                                    Back
                                </Button>
                                <Button
                                    type="submit"
                                    class="flex-grow-1"
                                    :tabindex="8"
                                    :disabled="
                                        processing || codeValue.length < 6
                                    "
                                >
                                    Confirm
                                </Button>
                            </div>
                        </div>
                    </Form>
                </template>
            </div>
        </DialogContent>
    </Dialog>
</template>
