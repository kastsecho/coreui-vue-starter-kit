<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { ListGroup, ListGroupItem } from '@/components/ui/list-group';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { edit as editSecurity } from '@/routes/security';
import type { NavItem } from '@/types';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: editProfile(),
    },
    {
        title: 'Security',
        href: editSecurity(),
    },
    {
        title: 'Appearance',
        href: editAppearance(),
    },
];

const { isCurrentOrParentUrl } = useCurrentUrl();
</script>

<template>
    <Container>
        <Heading
            title="Settings"
            description="Manage your profile and account settings"
        />

        <Row class="gap-md-0 mt-3 gap-4">
            <Column :md="4" :lg="3">
                <ListGroup class="rounded-4 shadow-sm">
                    <ListGroupItem
                        v-for="item in sidebarNavItems"
                        :key="item.title"
                        :href="item.href"
                        :active="isCurrentOrParentUrl(item.href)"
                    >
                        {{ item.title }}
                    </ListGroupItem>
                </ListGroup>
            </Column>

            <Column :md="8" :lg="6">
                <slot />
            </Column>
        </Row>
    </Container>
</template>
