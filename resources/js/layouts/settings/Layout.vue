<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import { ListGroup, ListGroupLink } from '@/components/ui/list-group';
import { toUrl, urlIsActive } from '@/lib/utils';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { edit as editPassword } from '@/routes/password';
import type { NavItem } from '@/types';
import { CCol, CRow } from '@coreui/vue';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: editProfile(),
    },
    {
        title: 'Password',
        href: editPassword(),
    },
    {
        title: 'Appearance',
        href: editAppearance(),
    },
];

const currentPath = typeof window !== undefined ? window.location.pathname : '';
</script>

<template>
    <div>
        <Heading
            title="Settings"
            description="Manage your profile and account settings"
        />

        <CRow>
            <CCol md="4" lg="3">
                <ListGroup class="rounded-4 shadow-sm" as="nav">
                    <template v-for="item in sidebarNavItems" :key="toUrl(item.href)">
                        <ListGroupLink
                            as="button"
                            :href="item.href"
                            :active="urlIsActive(item.href, currentPath)"
                        >
                            <Icon v-if="item.icon" :name="item.icon" />
                            {{ item.title }}
                        </ListGroupLink>
                    </template>
                </ListGroup>
            </CCol>

            <CCol class="mt-4 mt-md-0" md="8" lg="6">
                <slot />
            </CCol>
        </CRow>
    </div>
</template>
