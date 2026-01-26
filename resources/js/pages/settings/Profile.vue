<script setup lang="ts">
import { Form, Head, router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import TextLink from '@/components/TextLink.vue';
import { Alert } from '@/components/ui/alert';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { Input, InputError, Label } from '@/components/ui/input';
import { getInitials } from '@/composables/useInitials';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/profile';
import { destroy } from '@/routes/profile-photo';
import { update } from '@/routes/user-profile-information';
import { send } from '@/routes/verification';
import { type BreadcrumbItem } from '@/types';

type Props = {
    mustVerifyEmail: boolean;
    status?: string;
};

const page = usePage();
const user = computed(() => page.props.auth.user);

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: edit().url,
    },
];

const photoPreview = ref<string | null>(null);
const photoInput = ref<HTMLInputElement | null>(null);

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
};

const deletePhoto = () => {
    router.delete(destroy(), {
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
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile settings" />

        <h1 class="visually-hidden">Profile Settings</h1>

        <SettingsLayout>
            <div class="d-flex flex-column gap-3">
                <Heading
                    variant="small"
                    title="Profile information"
                    description="Update your avatar, name and email address"
                />

                <Form
                    v-bind="update.form()"
                    v-slot="{ errors, processing, recentlySuccessful }"
                    class="d-flex flex-column gap-3"
                >
                    <div class="d-grid gap-3">
                        <div class="d-grid">
                            <Label for="photo">Photo</Label>
                            <input
                                ref="photoInput"
                                id="photo"
                                name="photo"
                                type="file"
                                class="d-none"
                                accept="image/*"
                                @change="updatePhotoPreview"
                            />
                            <div class="d-flex align-items-center gap-4">
                                <AvatarImage
                                    v-if="user.avatar || photoPreview"
                                    :src="photoPreview || user.avatar"
                                    :alt="user.name"
                                    size="xl"
                                />
                                <AvatarFallback
                                    v-else
                                    class="fw-semibold"
                                    size="xl"
                                >
                                    {{ getInitials(user.name) }}
                                </AvatarFallback>

                                <Button
                                    type="button"
                                    color="secondary"
                                    @click="selectNewPhoto"
                                    :tabindex="1"
                                    :disabled="processing"
                                    data-test="update-profile-photo-button"
                                >
                                    <template v-if="user.avatar">
                                        Change Photo
                                    </template>

                                    <template v-else>Upload Photo</template>
                                </Button>

                                <Button
                                    v-if="user.avatar || photoPreview"
                                    type="button"
                                    color="secondary"
                                    @click="deletePhoto"
                                    :tabindex="2"
                                    :disabled="processing"
                                    data-test="remove-profile-photo-button"
                                >
                                    Remove Photo
                                </Button>
                            </div>
                            <InputError
                                :class="{ ['d-block']: errors.photo }"
                                :message="errors.photo"
                            />
                        </div>

                        <div class="d-grid">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                name="name"
                                required
                                :invalid="!!errors.name"
                                :value="user.name"
                                :tabindex="3"
                                autocomplete="name"
                                placeholder="Full name"
                            />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="d-grid">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                required
                                :invalid="!!errors.email"
                                :value="user.email"
                                :tabindex="4"
                                autocomplete="email"
                                placeholder="Email address"
                            />
                            <InputError class="mt-2" :message="errors.email" />
                        </div>
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-muted">
                            Your email address is unverified.
                            <TextLink
                                class="btn btn-link"
                                :href="send()"
                                :tabindex="4"
                                as="button"
                            >
                                Click here to resend the verification email.
                            </TextLink>
                        </p>

                        <Alert
                            v-if="status === 'verification-link-sent'"
                            class="fw-medium rounded-4 shadow-sm"
                            color="success"
                        >
                            A new verification link has been sent to your email
                            address.
                        </Alert>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <Button
                            type="submit"
                            :disabled="processing"
                            :tabindex="5"
                            data-test="update-profile-button"
                        >
                            Save
                        </Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-show="recentlySuccessful"
                                class="mb-0 text-muted"
                            >
                                Saved.
                            </p>
                        </Transition>
                    </div>
                </Form>

                <DeleteUser />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
