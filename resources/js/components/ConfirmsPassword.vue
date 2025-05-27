<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import {
    CButton,
    CFormInput,
    CFormLabel,
    CModal,
    CModalBody,
    CModalFooter,
    CModalHeader,
    CModalTitle
} from '@coreui/vue';
import type { InertiaForm } from '@inertiajs/vue3';
import { toRef } from 'vue';

const emit = defineEmits(['confirming', 'close']);

interface Props {
    button?: string;
    buttonColor?: string;
    form: InertiaForm<{ password: string }>;
    title?: string;
    visible: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    button: 'Confirm',
    buttonColor: 'primary',
    title: 'Confirm Password',
});

const password = toRef(props.form, 'password');

const closeModal = () => emit('close');

const startConfirmingPassword = () => emit('confirming');
</script>

<template>
    <div>
        <slot />

        <CModal teleport :visible @close="closeModal">
            <form @submit.prevent="startConfirmingPassword">
                <CModalHeader>
                    <CModalTitle class="fs-6">{{ title }}</CModalTitle>
                </CModalHeader>

                <CModalBody>
                    <div class="d-grid">
                        <p class="small text-muted">
                            <slot v-if="$slots.content" name="content" />
                            <template v-else>For your security, please confirm your password to continue.</template>
                        </p>

                        <div class="d-grid">
                            <CFormLabel for="password" class="visually-hidden">Password</CFormLabel>
                            <CFormInput
                                id="password"
                                type="password"
                                required
                                name="password"
                                v-model="password"
                                placeholder="Password"
                                :invalid="!!form.errors.password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                    </div>
                </CModalBody>

                <CModalFooter>
                    <CButton type="button" color="secondary" @click="closeModal">Cancel</CButton>

                    <CButton type="submit" :color="buttonColor" :disabled="form.processing">{{ button }}</CButton>
                </CModalFooter>
            </form>
        </CModal>
    </div>
</template>
