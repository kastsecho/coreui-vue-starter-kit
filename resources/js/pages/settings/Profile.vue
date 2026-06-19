<script setup lang="ts">
import {
    Form,
    Head,
    Link,
    router,
    setLayoutProps,
    usePage,
} from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { ImageInput, Input, InputFeedback, Label } from '@/components/ui/form';
import { Spinner } from '@/components/ui/spinner';
import { getInitials } from '@/composables/useInitials';
import { edit } from '@/routes/profile';
import { destroy } from '@/routes/profile-photo';
import { update } from '@/routes/user-profile-information';
import { send } from '@/routes/verification';

defineProps<{
    mustVerifyEmail: boolean;
    status?: string;
}>();

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Profile',
            href: edit(),
        },
    ],
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const photoPreview = ref<string | null>(null);
const photoInput = ref<InstanceType<typeof ImageInput> | null>(null);

const selectNewPhoto = () => {
    photoInput.value?.click();
};

const updatePhotoPreview = ({ src }: { src: string; file: File }) => {
    photoPreview.value = src;
};

const deletePhoto = () => {
    router.delete(destroy(), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            photoInput.value?.reset();
        },
    });
};
</script>

<template>
    <Head title="Profile settings" />

    <h1 class="visually-hidden">Profile settings</h1>
    <div class="d-flex flex-column row-gap-3">
        <Heading
            variant="small"
            title="Profile information"
            description="Update your avatar, name and email address"
        />

        <Form
            v-bind="update.form()"
            v-slot="{ errors, processing }"
            error-bag="updateProfileInformation"
            class="d-flex flex-column gap-3"
        >
            <div class="d-grid">
                <Label for="photo">Photo</Label>
                <ImageInput
                    ref="photoInput"
                    id="photo"
                    name="photo"
                    class="d-none"
                    @loaded="updatePhotoPreview"
                />
                <div class="d-flex align-items-center gap-4">
                    <AvatarImage
                        v-if="user.avatar || photoPreview"
                        :src="photoPreview || user.avatar"
                        :alt="user.name"
                        size="xl"
                    />
                    <AvatarFallback v-else class="fw-semibold" size="xl">
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
                        <template v-if="user.avatar">Change Photo</template>
                        <template v-else>Upload Photo</template>
                    </Button>

                    <Button
                        v-if="user.avatar || photoPreview"
                        type="button"
                        color="secondary"
                        :tabindex="2"
                        @click="deletePhoto"
                        :disabled="processing"
                        data-test="remove-profile-photo-button"
                    >
                        Remove Photo
                    </Button>
                </div>
                <InputFeedback
                    :class="{ ['d-block']: errors.photo }"
                    :message="errors.photo"
                    invalid
                />
            </div>

            <div class="d-grid">
                <Label for="name">Name</Label>
                <Input
                    id="name"
                    name="name"
                    type="text"
                    :model-value="user.name"
                    required
                    :tabindex="3"
                    autocomplete="name"
                    placeholder="Full name"
                    :invalid="!!errors.name"
                />
                <InputFeedback :message="errors.name" invalid />
            </div>

            <div class="d-grid">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    name="email"
                    type="email"
                    :model-value="user.email"
                    required
                    :tabindex="4"
                    autocomplete="username"
                    placeholder="Email address"
                    :invalid="!!errors.email"
                />
                <InputFeedback :message="errors.email" invalid />
            </div>

            <div v-if="mustVerifyEmail && !user.email_verified_at">
                <div class="d-flex align-items-center mt-n2">
                    <InputFeedback
                        class="small text-muted"
                        message="Your email address is unverified."
                    />

                    <Link
                        :href="send()"
                        as="button"
                        class="btn btn-link link-body-emphasis"
                        :tabindex="5"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </div>

                <InputFeedback
                    v-if="status === 'verification-link-sent'"
                    class="d-block"
                    message="A new verification link has been sent to your email address."
                    valid
                />
            </div>

            <div class="d-flex align-items-center gap-4">
                <Button
                    type="submit"
                    :tabindex="6"
                    :disabled="processing"
                    data-test="update-profile-button"
                >
                    <Spinner v-if="processing" />
                    Save
                </Button>
            </div>
        </Form>

        <DeleteUser />
    </div>
</template>
