<script setup lang="ts">
import { usePasskeyRegister } from '@laravel/passkeys/vue';
import { ref } from 'vue';
import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input, InputFeedback, Label } from '@/components/ui/form';

const emit = defineEmits<{
    success: [];
}>();

const getDefaultPasskeyName = () => {
    const ua = navigator.userAgent;

    const browser = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera'].find(
        (browser) => new RegExp(browser).test(ua),
    );

    const os = ['iPhone', 'iPad', 'Android', 'Mac', 'Windows'].find((os) =>
        new RegExp(os).test(ua),
    );

    return [browser, os].filter(Boolean).join(' on ') || '';
};

const name = ref(getDefaultPasskeyName());
const showForm = ref(false);

const { register, isLoading, error, isSupported } = usePasskeyRegister({
    onSuccess: () => {
        name.value = '';
        showForm.value = false;
        emit('success');
    },
});

const handleSubmit = async (event: Event) => {
    event.preventDefault();

    if (!name.value.trim()) {
        return;
    }

    await register(name.value);
};

const handleCancel = () => {
    showForm.value = false;
    name.value = '';
};
</script>

<template>
    <div v-if="!isSupported" class="text-muted-foreground text-sm">
        Passkeys are not supported in this browser.
    </div>

    <Button
        v-else-if="!showForm"
        class="me-auto"
        color="light"
        variant="outline"
        @click="showForm = true"
    >
        Add passkey
    </Button>

    <Alert v-else class="rounded-4 shadow-sm" color="light">
        <form @submit="handleSubmit" class="d-flex flex-column gap-2">
            <div class="d-grid">
                <Label for="passkey-name">Passkey name</Label>
                <Input
                    id="passkey-name"
                    type="text"
                    v-model="name"
                    placeholder="e.g., MacBook Pro, iPhone"
                    autofocus
                    :invalid="!!error"
                />
                <p class="form-text">
                    A name helps you identify this passkey later.
                </p>

                <InputFeedback v-if="error" :message="error" invalid />
            </div>

            <div class="d-flex gap-2">
                <Button type="submit" :disabled="isLoading || !name.trim()">
                    {{ isLoading ? 'Registering...' : 'Register passkey' }}
                </Button>
                <Button
                    type="button"
                    class="link-body-emphasis"
                    color="link"
                    @click="handleCancel"
                >
                    Cancel
                </Button>
            </div>
        </form>
    </Alert>
</template>
