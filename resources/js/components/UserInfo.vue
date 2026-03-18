<script setup lang="ts">
import { computed } from 'vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { AppVariant, User } from '@/types';

type Props = {
    user: User;
    showEmail?: boolean;
    variant?: AppVariant;
};

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
    variant: 'header',
});

const { getInitials } = useInitials();

// Compute whether we should show the avatar image
const showAvatar = computed(
    () => props.user.avatar && props.user.avatar !== '',
);
</script>

<template>
    <template v-if="variant === 'header'">
        <AvatarImage
            v-if="showAvatar"
            :src="user.avatar!"
            :alt="user.name"
            size="sm"
        />
        <AvatarFallback v-else class="fw-semibold" size="sm">
            {{ getInitials(user.name) }}
        </AvatarFallback>

        <div class="d-grid flex-grow-1 text-start">
            <span class="text-truncate fw-medium">{{ user.name }}</span>
            <span v-if="showEmail" class="text-truncate text-muted">
                {{ user.email }}
            </span>
        </div>
    </template>
    <template v-else>
        <div class="nav-icon">
            <AvatarImage
                v-if="showAvatar"
                :src="user.avatar!"
                :alt="user.name"
                shape="rounded"
                size="sm"
            />
            <AvatarFallback
                v-else
                class="fw-semibold text-white"
                shape="rounded"
                size="sm"
            >
                {{ getInitials(user.name) }}
            </AvatarFallback>
        </div>
        <span class="text-truncate">{{ user.name }}</span>
    </template>
</template>
