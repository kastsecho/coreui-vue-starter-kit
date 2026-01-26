<script setup lang="ts">
import { CCol, CRow } from '@coreui/vue';
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import { ListGroup, ListGroupLink } from '@/components/ui/list-group';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { toUrl } from '@/lib/utils';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { edit as editTwoFactor } from '@/routes/two-factor';
import { edit as editPassword } from '@/routes/user-password';
import { type NavItem } from '@/types';

const { isCurrentUrl } = useCurrentUrl();

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
        title: 'Two-Factor Auth',
        href: editTwoFactor(),
    },
    {
        title: 'Appearance',
        href: editAppearance(),
    },
];
</script>

<template>
    <div class="d-grid gap-3">
        <Heading
            title="Settings"
            description="Manage your profile and account settings"
        />

        <CRow>
            <CCol md="4" lg="3">
                <ListGroup
                    as="nav"
                    class="rounded-4 shadow-sm"
                    aria-label="Settings"
                >
                    <ListGroupLink
                        v-for="item in sidebarNavItems"
                        :key="toUrl(item.href)"
                        :href="item.href"
                        :active="isCurrentUrl(item.href)"
                    >
                        <Icon v-if="item.icon" :name="item.icon" />
                        {{ item.title }}
                    </ListGroupLink>
                </ListGroup>
            </CCol>

            <CCol class="mt-4 mt-md-0" md="8" lg="6">
                <slot />
            </CCol>
        </CRow>
    </div>
</template>
