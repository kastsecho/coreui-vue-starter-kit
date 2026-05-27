<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { router } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { biKey } from '@/components/icon';
import PasskeyItem from '@/components/PasskeyItem.vue';
import PasskeyRegister from '@/components/PasskeyRegister.vue';
import { Alert, AlertTitle } from '@/components/ui/alert';
import { ListGroup } from '@/components/ui/list-group';
import { destroy } from '@/routes/passkey';
import type { Passkey } from '@/types/auth';

export type Props = {
    canManagePasskeys?: boolean;
    passkeys?: Passkey[];
};

withDefaults(defineProps<Props>(), {
    canManagePasskeys: false,
    passkeys: () => [],
});

const handleDelete = (id: number, onError: () => void) => {
    router.delete(destroy.url(id), {
        preserveScroll: true,
        onError,
    });
};

const handleRegisterSuccess = () => {
    router.reload();
};
</script>

<template>
    <div v-if="canManagePasskeys" class="d-grid row-gap-3 mt-3">
        <Heading
            variant="small"
            title="Passkeys"
            description="Manage your passkeys for passwordless sign-in"
        />

        <ListGroup v-if="passkeys?.length" class="rounded-4 shadow-sm">
            <PasskeyItem
                v-for="passkey in passkeys"
                :key="passkey.id"
                :passkey="passkey"
                @remove="handleDelete"
            />
        </ListGroup>

        <Alert v-else class="rounded-4 shadow-sm" color="light">
            <div class="text-center">
                <CIconSvg
                    custom-class-name="border bg-body-tertiary text-muted mx-auto mb-3 p-3 rounded-4 icon icon-4xl"
                >
                    <biKey />
                </CIconSvg>

                <AlertTitle as="h5" class="fw-semibold">
                    No passkeys yet
                </AlertTitle>
                <p class="small text-muted fw-medium">
                    Add a passkey to sign in without a password
                </p>
            </div>
        </Alert>

        <PasskeyRegister @success="handleRegisterSuccess" />
    </div>
</template>
