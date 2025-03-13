<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { CAlert, CAlertHeading, CButton, CFormInput, CFormLabel, CModal, CModalBody, CModalFooter, CModalHeader, CModalTitle } from '@coreui/vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<HTMLInputElement | null>(null);
const visible = ref<boolean>(false);

const form = useForm({
    password: '',
});

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
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

            <CButton type="button" color="danger" @click="visible = true">Delete account</CButton>
        </CAlert>

        <CModal teleport :visible @close="closeModal">
            <form @submit.prevent="deleteUser">
                <CModalHeader>
                    <CModalTitle class="fs-6">Are you sure you want to delete your account?</CModalTitle>
                </CModalHeader>

                <CModalBody>
                    <div class="d-grid">
                        <p class="small text-muted">
                            Once your account is deleted, all of its resources and data will also be permanently deleted. Please enter your password
                            to confirm you would like to permanently delete your account.
                        </p>

                        <div class="d-grid">
                            <CFormLabel for="password" class="visually-hidden">Password</CFormLabel>
                            <CFormInput
                                id="password"
                                type="password"
                                ref="passwordInput"
                                required
                                name="password"
                                v-model="form.password"
                                placeholder="Password"
                                :invalid="!!form.errors.password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                    </div>
                </CModalBody>

                <CModalFooter>
                    <CButton type="button" color="secondary" @click="closeModal">Cancel</CButton>

                    <CButton type="submit" color="danger" :disabled="form.processing">Delete account</CButton>
                </CModalFooter>
            </form>
        </CModal>
    </div>
</template>
