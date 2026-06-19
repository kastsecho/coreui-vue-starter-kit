<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { computed } from 'vue';
import { AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import { cilOptions } from '@/icons';
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
            class="avatar-md"
            :src="user.avatar!"
            :alt="user.name"
        />
        <AvatarFallback v-else class="avatar-md fw-semibold">
            {{ getInitials(user.name) }}
        </AvatarFallback>
        <div class="small text-start text-white">
            <div class="text-truncate fw-semibold">{{ user.name }}</div>
            <div v-if="showEmail" class="text-truncate text-muted">
                {{ user.email }}
            </div>
        </div>
    </template>
    <template v-else>
        <AvatarImage v-if="showAvatar" :src="user.avatar!" :alt="user.name" />
        <AvatarFallback v-else class="fw-semibold">
            {{ getInitials(user.name) }}
        </AvatarFallback>
        <div class="small d-sidebar-narrow-none text-start text-white">
            <div class="text-truncate fw-semibold">{{ user.name }}</div>
            <div v-if="showEmail" class="text-truncate text-muted">
                {{ user.email }}
            </div>
        </div>
        <CIcon
            class="nav-icon d-sidebar-narrow-none ms-auto"
            :icon="cilOptions"
        />
    </template>
</template>
