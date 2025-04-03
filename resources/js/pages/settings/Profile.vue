<script setup lang="ts">
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import Toast from '@/components/Toast.vue';
import { getInitials } from '@/composables/useInitials';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem, SharedData, User } from '@/types';
import { CAvatar, CButton, CFormInput, CFormLabel } from '@coreui/vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineProps<{
    mustVerifyEmail: boolean;
    status?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const verificationLinkSent = ref<boolean>(false);

const page = usePage<SharedData>();
const user = computed(() => page.props.auth.user as User);

const photoPreview = ref<string | null>(null);
const photoInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    _method: 'put',
    name: user.value.name,
    email: user.value.email,
    photo: null as File | null,
});

const submit = () => {
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput?.value?.click();
};

const updatePhotoPreview = () => {
    const file = photoInput.value?.files?.[0];
    if (!file || !file.type.startsWith('image/')) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        if (e.target?.result) {
            photoPreview.value = e.target.result.toString();
        }
    };
    reader.readAsDataURL(file);
    form.photo = file;
};

const deletePhoto = () => {
    router.delete(route('profile-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value) {
        photoInput.value.value = '';
    }
};
</script>

<template>
    <AppLayout :breadcrumbs>
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall title="Profile information" description="Update your avatar, name and email address" />

                <form @submit.prevent="submit" class="d-grid gap-3">
                    <div class="d-grid">
                        <CFormLabel for="photo">Photo</CFormLabel>
                        <input id="photo" ref="photoInput" class="d-none" type="file" accept="image/*" @change="updatePhotoPreview" />
                        <div class="d-flex align-items-center gap-4">
                            <CAvatar
                                v-if="user.avatar || photoPreview"
                                shape="rounded-circle"
                                size="xl"
                                :src="photoPreview || user.avatar"
                                :alt="user.name"
                            />
                            <CAvatar v-else color="secondary" text-color="white" shape="rounded-circle" size="xl">
                                {{ getInitials(user.name) }}
                            </CAvatar>

                            <CButton type="button" color="light" @click="selectNewPhoto">
                                {{ user.avatar ? 'Change Photo' : 'Upload Photo' }}
                            </CButton>

                            <CButton v-if="user.avatar || photoPreview" type="button" color="light" @click="deletePhoto">Remove Photo</CButton>
                        </div>
                        <InputError :class="['mt-2', { 'd-block': form.errors.photo }]" :message="form.errors.photo" />
                    </div>

                    <div class="d-grid">
                        <CFormLabel for="name">Name</CFormLabel>
                        <CFormInput
                            id="name"
                            type="text"
                            required
                            autocomplete="name"
                            v-model="form.name"
                            placeholder="Full name"
                            :invalid="!!form.errors.name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="d-grid">
                        <CFormLabel for="email">Email address</CFormLabel>
                        <CFormInput
                            id="email"
                            type="email"
                            required
                            autocomplete="username"
                            v-model="form.email"
                            placeholder="Email address"
                            :invalid="!!form.errors.email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <template v-if="mustVerifyEmail && !user.email_verified_at">
                        <div class="d-flex align-items-center justify-content-between small text-muted">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="btn btn-link link-body-emphasis"
                                @click.prevent="sendEmailVerification"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </div>
                    </template>

                    <div class="d-flex align-items-center gap-3">
                        <CButton type="submit" color="primary" :disabled="form.processing">Save</CButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="mb-0 text-muted">Saved.</p>
                        </Transition>
                    </div>
                </form>

                <DeleteUser />
            </div>
        </SettingsLayout>

        <template #toast>
            <Toast v-if="verificationLinkSent" class="fw-medium text-green-600" @close="verificationLinkSent = false">
                A new verification link has been sent to your email address.
            </Toast>
        </template>
    </AppLayout>
</template>
