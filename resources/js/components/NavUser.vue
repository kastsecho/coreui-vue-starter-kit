<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import type { SharedData, User } from '@/types';
import { CNavGroup, CNavTitle } from '@coreui/vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage<SharedData>();
const user = computed(() => page.props.auth.user as User);
</script>

<template>
    <CNavTitle>Platform</CNavTitle>
    <CNavGroup>
        <template #togglerContent>
            <UserInfo variant="sidebar" :user />
        </template>

        <UserMenuContent variant="sidebar" :user />
    </CNavGroup>
</template>
