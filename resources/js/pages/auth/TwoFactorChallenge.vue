<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { computed, ref, watchEffect } from 'vue';
import { Button } from '@/components/ui/button';
import { Input, InputFeedback } from '@/components/ui/form';
import {
    InputOTP,
    InputOTPGroup,
    InputOTPSlot,
} from '@/components/ui/input-otp';
import { Separator } from '@/components/ui/separator';
import { store } from '@/routes/two-factor/login';
import type { TwoFactorConfigContent } from '@/types';

const showRecoveryInput = ref<boolean>(false);
const code = ref<string>('');

const authConfigContent = computed<TwoFactorConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Recovery code',
            description:
                'Please confirm access to your account by entering one of your emergency recovery codes.',
            buttonText: 'or, login using an authentication code',
        };
    }

    return {
        title: 'Authentication code',
        description:
            'Enter the authentication code provided by your authenticator application.',
        buttonText: 'or, login using a recovery code',
    };
});

watchEffect(() => {
    setLayoutProps({
        title: authConfigContent.value.title,
        description: authConfigContent.value.description,
    });
});

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = '';
};
</script>

<template>
    <Head title="Two-factor authentication" />

    <template v-if="!showRecoveryInput">
        <Form
            v-bind="store.form()"
            reset-on-error
            @error="code = ''"
            v-slot="{ errors, processing, clearErrors }"
            class="d-flex flex-column gap-3"
        >
            <input type="hidden" name="code" :value="code" />
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <InputOTP
                        id="otp"
                        v-model="code"
                        :maxlength="6"
                        :disabled="processing"
                        autofocus
                    >
                        <InputOTPGroup
                            :class="{
                                ['is-invalid']: errors?.code,
                            }"
                        >
                            <InputOTPSlot
                                v-for="index in 6"
                                :key="index"
                                :index="index - 1"
                            />
                        </InputOTPGroup>
                        <InputFeedback :message="errors.code" invalid />
                    </InputOTP>
                </div>

                <Button type="submit" class="mt-4" :disabled="processing">
                    Continue
                </Button>
            </div>

            <Separator :spacing="2">
                <Button
                    type="button"
                    class="link-body-emphasis fw-semibold"
                    color="link"
                    @click="() => toggleRecoveryMode(clearErrors)"
                >
                    {{ authConfigContent.buttonText }}
                </Button>
            </Separator>
        </Form>
    </template>

    <template v-else>
        <Form
            v-bind="store.form()"
            reset-on-error
            v-slot="{ errors, processing, clearErrors }"
            class="d-flex flex-column gap-3"
        >
            <div class="d-grid gap-3">
                <div class="d-grid">
                    <Input
                        id="recovery_code"
                        type="text"
                        name="recovery_code"
                        required
                        :autofocus="showRecoveryInput"
                        :tabindex="1"
                        placeholder="Enter recovery code"
                        :invalid="!!errors.recovery_code"
                    />
                    <InputFeedback :message="errors.recovery_code" invalid />
                </div>

                <Button type="submit" class="mt-4" :disabled="processing">
                    Continue
                </Button>
            </div>

            <Separator :spacing="2">
                <Button
                    type="button"
                    class="link-body-emphasis fw-semibold"
                    color="link"
                    @click="() => toggleRecoveryMode(clearErrors)"
                >
                    {{ authConfigContent.buttonText }}
                </Button>
            </Separator>
        </Form>
    </template>
</template>
