<script setup lang="ts">
import ConfirmsPassword from '@/components/ConfirmsPassword.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { CAlert, CAlertHeading, CButton } from '@coreui/vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const visible = ref<boolean>(false);

const form = useForm({
    password: '',
});

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    form.clearErrors();
    form.reset();
    visible.value = false;
};
</script>

<template>
    <div class="d-grid gap-3">
        <HeadingSmall title="Delete account" description="Delete your account and all of its resources" />

        <CAlert color="danger">
            <CAlertHeading class="fs-6">Warning</CAlertHeading>
            <p>Please proceed with caution, this cannot be undone.</p>

            <ConfirmsPassword
                title="Are you sure you want to delete your account?"
                button="Delete account"
                button-color="danger"
                :form
                :visible
                @close="closeModal"
                @confirming="deleteUser"
            >
                <CButton type="button" color="danger" @click="visible = true">Delete account</CButton>

                <template #content>
                    Once your account is deleted, all of its resources and data will also be permanently deleted. Please enter your password to
                    confirm you would like to permanently delete your account.
                </template>
            </ConfirmsPassword>
        </CAlert>
    </div>
</template>
