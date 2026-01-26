<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input, InputError } from '@/components/ui/input';
import {
    InputOTP,
    InputOTPGroup,
    InputOTPSlot,
} from '@/components/ui/input-otp';
import { Separator } from '@/components/ui/separator';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/two-factor/login';
import { type TwoFactorConfigContent } from '@/types';

const authConfigContent = computed<TwoFactorConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Recovery Code',
            description:
                'Please confirm access to your account by entering one of your emergency recovery codes.',
            buttonText: 'or, using an authentication code',
        };
    }

    return {
        title: 'Authentication Code',
        description:
            'Enter the authentication code provided by your authenticator application.',
        buttonText: 'or, login using a recovery code',
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = '';
};

const code = ref<string>('');
</script>

<template>
    <AuthLayout
        :title="authConfigContent.title"
        :description="authConfigContent.description"
    >
        <Head title="Two-Factor Authentication" />

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
                            <InputOTPGroup>
                                <InputOTPSlot
                                    v-for="index in 6"
                                    :key="index"
                                    :index="index - 1"
                                />
                            </InputOTPGroup>
                        </InputOTP>
                        <InputError
                            :class="{ ['d-block']: errors.code }"
                            :message="errors.code"
                        />
                    </div>

                    <Button type="submit" :disabled="processing">
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
                class="d-flex flex-column gap-3"
                reset-on-error
                #default="{ errors, processing, clearErrors }"
            >
                <div class="d-grid gap-3">
                    <div class="d-grid">
                        <Input
                            id="recovery_code"
                            type="text"
                            name="recovery_code"
                            required
                            placeholder="Enter recovery code"
                            :autofocus="showRecoveryInput"
                        />
                        <InputError :message="errors.recovery_code" />
                    </div>

                    <Button type="submit" :disabled="processing">
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
    </AuthLayout>
</template>
