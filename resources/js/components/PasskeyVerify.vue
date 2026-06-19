<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import type { UrlMethodPair } from '@inertiajs/core';
import { router } from '@inertiajs/vue3';
import { usePasskeyVerify } from '@laravel/passkeys/vue';
import biKey from '@/components/icon/biKey.vue';
import { Button } from '@/components/ui/button';
import { InputFeedback } from '@/components/ui/form';
import { Separator } from '@/components/ui/separator';
import { Spinner } from '@/components/ui/spinner';

type Props = {
    routes?: {
        options: UrlMethodPair;
        submit: UrlMethodPair;
    };
    label?: string;
    loadingLabel?: string;
    separator?: string;
};

const props = defineProps<Props>();

const { verify, isLoading, error, isSupported } = usePasskeyVerify({
    ...(props.routes
        ? {
              routes: {
                  options: props.routes.options.url,
                  submit: props.routes.submit.url,
              },
          }
        : {}),
    onSuccess: (response) => {
        router.visit(response.redirect ?? '/dashboard');
    },
});
</script>

<template>
    <div v-if="isSupported">
        <div class="d-grid gap-2">
            <Button
                type="button"
                color="light"
                variant="outline"
                @click="verify"
                :disabled="isLoading"
            >
                <Spinner v-if="isLoading" />
                <CIconSvg v-else>
                    <biKey class="me-2" />
                </CIconSvg>
                {{
                    isLoading
                        ? (props.loadingLabel ?? 'Authenticating...')
                        : (props.label ?? 'Sign in with a passkey')
                }}
            </Button>

            <div v-if="error" class="text-center">
                <InputFeedback class="d-block" :message="error" invalid />
            </div>
        </div>

        <Separator class="text-uppercase my-3" color="body-secondary">
            {{ props.separator ?? 'Or continue with email' }}
        </Separator>
    </div>
</template>
