<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import type { NavItem, SharedData } from '@/types';
import { CCol, CListGroup, CRow } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile',
    },
    {
        title: 'Password',
        href: '/settings/password',
    },
    {
        title: 'Appearance',
        href: '/settings/appearance',
    },
];

const page = usePage<SharedData>();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <Heading title="Settings" description="Manage your profile and account settings" />

    <CRow>
        <CCol md="4" lg="3">
            <CListGroup as="nav">
                <Link
                    v-for="item in sidebarNavItems"
                    :key="item.href"
                    class="list-group-item list-group-item-action"
                    :class="{ active: currentPath === item.href }"
                    :href="item.href"
                >
                    {{ item.title }}
                </Link>
            </CListGroup>
        </CCol>

        <CCol md="8" lg="6">
            <slot />
        </CCol>
    </CRow>
</template>
