<script setup lang="ts">
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { computed } from 'vue';

interface Props {
    user: User;
    showEmail?: boolean;
    variant?: 'header' | 'sidebar';
}

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
    <template v-if="variant === 'sidebar'">
        <div class="nav-icon">
            <AvatarImage
                v-if="showAvatar"
                :src="user.avatar!"
                :alt="user.name"
                size="sm"
            />
            <AvatarFallback v-else class="fw-semibold text-white" size="sm">
                {{ getInitials(user.name) }}
            </AvatarFallback>
        </div>
        <span class="text-truncate">{{ user.name }}</span>
    </template>

    <template v-else>
        <AvatarImage
            v-if="showAvatar"
            :src="user.avatar!"
            :alt="user.name"
            size="sm"
        />
        <AvatarFallback v-else class="fw-semibold text-white" size="sm">
            {{ getInitials(user.name) }}
        </AvatarFallback>

        <div class="d-grid flex-grow-1">
            <span class="text-truncate fw-medium">{{ user.name }}</span>
            <span v-if="showEmail" class="text-truncate small text-muted">
                {{ user.email }}
            </span>
        </div>
    </template>
</template>
