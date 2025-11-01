<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input, InputError } from '@/components/ui/input';
import { PinInput, PinInputGroup, PinInputSlot } from '@/components/ui/pin-input';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/two-factor/login';
import { Form, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface AuthConfigContent {
    title: string;
    description: string;
    toggleText: string;
}

const authConfigContent = computed<AuthConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Recovery Code',
            description: 'Please confirm access to your account by entering one of your emergency recovery codes.',
            toggleText: 'login using an authentication code',
        };
    }

    return {
        title: 'Authentication Code',
        description: 'Enter the authentication code provided by your authenticator application.',
        toggleText: 'login using a recovery code',
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = [];
};

const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join(''));
</script>

<template>
    <AuthLayout :title="authConfigContent.title" :description="authConfigContent.description">
        <Head title="Two-Factor Authentication" />

        <template v-if="!showRecoveryInput">
            <Form
                v-bind="store.form()"
                reset-on-error
                @error="code = []"
                v-slot="{ errors, processing, clearErrors }"
            >
                <input type="hidden" name="code" :value="codeValue" />
                <div class="d-grid gap-3">
                    <div class="d-grid">
                        <PinInput id="otp" v-model="code">
                            <PinInputGroup>
                                <PinInputSlot
                                    class="text-center"
                                    autofocus
                                    v-for="(id, index) in 6"
                                    :key="id"
                                    :index="index"
                                    placeholder="○"
                                    :disabled="processing"
                                    @complete="(digit) => { code[index] = digit }"
                                />
                            </PinInputGroup>
                        </PinInput>
                        <InputError
                            :class="{['d-block']: errors.code}"
                            :message="errors.code"
                        />
                    </div>

                    <Button
                        type="submit"
                        :tabindex="7"
                        :disabled="processing"
                    >
                        <Spinner v-if="processing" size="sm" />
                        Continue
                    </Button>

                    <div class="d-flex w-100 align-items-center justify-content-center">
                        <hr class="flex-grow-1">
                        <span class="ps-2 text-muted">or you can</span>
                        <Button
                            type="button"
                            class="link-body-emphasis ps-2"
                            color="link"
                            :tabindex="8"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </Button>
                        <hr class="flex-grow-1">
                    </div>
                </div>
            </Form>
        </template>

        <template v-else>
            <Form v-bind="store.form()" class="space-y-4" reset-on-error #default="{ errors, processing, clearErrors }">
                <div class="d-grid gap-3">
                    <div class="d-grid">
                        <Input
                            id="recovery_code"
                            type="text"
                            name="recovery_code"
                            required
                            :tabindex="1"
                            autocomplete="one-time-code"
                            :autofocus="showRecoveryInput"
                            aria-label="Recovery Code"
                            placeholder="Enter recovery code"
                            :invalid="!!errors.recovery_code"
                        />
                        <InputError :message="errors.recovery_code" />
                    </div>

                    <Button
                        type="submit"
                        :tabindex="2"
                        :disabled="processing"
                    >
                        <Spinner v-if="processing" size="sm" />
                        Continue
                    </Button>

                    <div class="d-flex w-100 align-items-center justify-content-center">
                        <hr class="flex-grow-1">
                        <span class="ps-2 text-muted">or you can</span>
                        <Button
                            type="button"
                            class="link-body-emphasis ps-2"
                            color="link"
                            :tabindex="3"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </Button>
                        <hr class="flex-grow-1">
                    </div>
                </div>
            </Form>
        </template>
    </AuthLayout>
</template>
