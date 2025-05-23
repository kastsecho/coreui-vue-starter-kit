<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { PinInput } from '@/components/ui/pin';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CButton, CFormInput } from '@coreui/vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

type TwoFactorForm = {
    code: string;
    recovery_code: string;
    recovery: boolean;
};

const form = useForm<TwoFactorForm>({
    code: '',
    recovery_code: '',
    recovery: false,
});

// Handle completion of pin input
const pinComplete = (value: string[]) => {
    form.code = value.join('');
    if (form.code.length === 6) {
        submit();
    }
};

watch(
    () => form.code,
    (newValue: string) => {
        if (newValue && form.errors.code) {
            form.errors.code = '';
        }
    },
);

const submit = () => {
    form.post(route('two-factor.login'));
};

const toggleRecovery = () => {
    form.reset('code', 'recovery_code');
    form.recovery = !form.recovery;
    form.clearErrors();
};

const isDisabled = computed(() => {
    return form.processing || (form.recovery ? !form.recovery_code : !form.code || form.code.length !== 6);
});
</script>

<template>
    <AuthLayout
        :title="form.recovery ? 'Recovery Code' : 'Authentication Code'"
        :description="
            form.recovery
                ? 'Please confirm access to your account by entering one of your emergency recovery codes.'
                : 'Enter the authentication code provided by your authenticator application.'
        "
    >
        <Head title="Two Factor Authentication" />

        <form @submit.prevent="submit" class="d-flex flex-column gap-3 text-center">
            <div class="d-grid gap-3">
                <template v-if="!form.recovery">
                    <div class="d-grid gap-2 text-center">
                        <PinInput v-model="form.code" :length="6" :invalid="!!form.errors.code" @complete="pinComplete" />
                        <InputError :class="{ 'd-block': form.errors.code }" :message="form.errors.code" />
                    </div>
                </template>

                <template v-else>
                    <div class="d-grid gap-2">
                        <CFormInput
                            v-model="form.recovery_code"
                            type="text"
                            autocomplete="one-time-code"
                            placeholder="Enter recovery code"
                            autofocus
                            required
                            :invalid="!!form.errors.recovery_code"
                        />
                        <InputError :message="form.errors.recovery_code" />
                    </div>
                </template>

                <CButton color="primary" type="submit" :disabled="isDisabled">Continue</CButton>

                <div class="d-flex align-items-center justify-content-center text-muted">
                    <span>or you can</span>
                    <CButton type="button" class="btn-link link-body-emphasis" @click="toggleRecovery">
                        {{ form.recovery ? 'login using an authentication code' : 'login using a recovery code' }}
                    </CButton>
                </div>
            </div>
        </form>
    </AuthLayout>
</template>
