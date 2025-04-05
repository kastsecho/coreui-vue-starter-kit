<script setup lang="ts">
import { getInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { CAvatar } from '@coreui/vue';
import { computed } from 'vue';

interface Props {
    user: User;
    showEmail?: boolean;
    variant?: string;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
    variant: 'dropdown',
});

// Compute whether we should show the avatar image
const showAvatar = computed(() => props.user.avatar && props.user.avatar !== '');
</script>

<template>
    <template v-if="variant === 'sidebar'">
        <div class="nav-icon">
            <CAvatar v-if="!showAvatar" color="secondary" text-color="white" shape="rounded-circle" status="success" size="sm">
                {{ getInitials(user.name) }}
            </CAvatar>
            <CAvatar v-else shape="rounded-circle" status="success" size="sm" :src="user.avatar" :alt="user.name" />
        </div>
        <span class="text-truncate" v-text="user.name"></span>
    </template>

    <template v-else>
        <CAvatar v-if="!showAvatar" color="secondary" text-color="white" shape="rounded-circle" status="success">
            {{ getInitials(user.name) }}
        </CAvatar>
        <CAvatar v-else shape="rounded-circle" status="success" :src="user.avatar" :alt="user.name" />

        <div class="d-grid flex-grow-1 text-start">
            <span class="text-truncate fw-medium" v-text="user.name"></span>
            <span v-if="showEmail" class="text-truncate small text-muted" v-text="user.email"></span>
        </div>
    </template>
</template>
