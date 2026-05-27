<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { Form } from '@inertiajs/vue3';
import { onUnmounted, ref } from 'vue';
import Heading from '@/components/Heading.vue';
import { biShieldCheck, biShieldX } from '@/components/icon';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { disable, enable } from '@/routes/two-factor';

export type Props = {
    canManageTwoFactor?: boolean;
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
};

withDefaults(defineProps<Props>(), {
    canManageTwoFactor: false,
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => clearTwoFactorAuthData());
</script>

<template>
    <div v-if="canManageTwoFactor" class="d-grid row-gap-3 mt-3">
        <Heading
            variant="small"
            title="Two-factor authentication"
            description="Manage your two-factor authentication settings"
        />

        <div
            v-if="!twoFactorEnabled"
            class="d-flex flex-column align-items-start justify-content-start gap-2"
        >
            <p class="text-muted small fw-semibold">
                When you enable two-factor authentication, you will be prompted
                for a secure pin during login. This pin can be retrieved from a
                TOTP-supported application on your phone.
            </p>

            <div>
                <Button v-if="hasSetupData" @click="showSetupModal = true">
                    <CIconSvg>
                        <biShieldCheck />
                    </CIconSvg>
                    Continue setup
                </Button>
                <Form
                    v-else
                    v-bind="enable.form()"
                    v-slot="{ processing }"
                    @success="showSetupModal = true"
                >
                    <Button type="submit" :disabled="processing">
                        Enable 2FA
                    </Button>
                </Form>
            </div>
        </div>

        <div
            v-else
            class="d-flex flex-column align-items-start justify-content-start gap-2"
        >
            <p class="text-muted small fw-semibold">
                You will be prompted for a secure, random pin during login,
                which you can retrieve from the TOTP-supported application on
                your phone.
            </p>

            <div class="relative inline">
                <Form v-bind="disable.form()" v-slot="{ processing }">
                    <Button type="submit" color="danger" :disabled="processing">
                        <CIconSvg>
                            <biShieldX />
                        </CIconSvg>
                        Disable 2FA
                    </Button>
                </Form>
            </div>

            <TwoFactorRecoveryCodes />
        </div>

        <TwoFactorSetupModal
            v-model:isOpen="showSetupModal"
            :requiresConfirmation="requiresConfirmation"
            :twoFactorEnabled="twoFactorEnabled"
        />
    </div>
</template>
