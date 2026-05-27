<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import {
    NavigationMenu,
    NavigationMenuList,
} from '@/components/ui/navigation-menu';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { cilExternalLink } from '@/icons';
import { dashboard, login } from '@/routes';
/* @chisel-registration */
import { register } from '@/routes';
/* @end-chisel-registration */

defineProps<{
    laravel: string;
}>();

const page = usePage();
const auth = computed(() => page.props.auth);
</script>

<template>
    <Head title="Welcome" />
    <div
        class="d-flex flex-column align-items-center justify-content-center vh-100"
    >
        <NavigationMenu placement="fixed-top" container expand="md">
            <NavigationMenuList class="ms-auto gap-3">
                <template v-if="!auth.user">
                    <Button
                        as="Link"
                        color="link"
                        :href="login()"
                        class="link-body-emphasis text-decoration-none"
                    >
                        Log in
                    </Button>
                    <!-- @chisel-registration -->
                    <Button
                        as="Link"
                        color="dark"
                        :href="register()"
                        shape="rounded-pill"
                    >
                        Register
                    </Button>
                    <!-- @end-chisel-registration -->
                </template>
                <Button
                    v-else
                    as="Link"
                    color="dark"
                    :href="dashboard()"
                    shape="rounded-pill"
                >
                    Dashboard
                </Button>
            </NavigationMenuList>
        </NavigationMenu>

        <Container fluid>
            <Row class="justify-content-center">
                <Column :md="10" :lg="8" :xl="6">
                    <Card class="rounded-5 shadow-sm">
                        <CardContent class="p-5">
                            <Row>
                                <Column :md="6" class="text-muted text-center">
                                    <AppLogoIcon
                                        class="text-danger mb-3"
                                        width="48"
                                        height="48"
                                    />
                                    <h1 class="text-body-emphasis">
                                        Laravel
                                        <small class="text-danger">
                                            v{{ laravel }}
                                        </small>
                                    </h1>
                                    <p class="fw-medium text-center">
                                        Laravel has an incredibly rich
                                        ecosystem. We suggest starting with the
                                        following.
                                    </p>
                                </Column>
                                <Column
                                    :md="6"
                                    class="d-flex flex-column justify-content-center gap-3"
                                >
                                    <Button
                                        as="a"
                                        color="danger"
                                        href="https://laravel.com/docs"
                                        shape="rounded-pill"
                                        variant="outline"
                                        target="_blank"
                                    >
                                        Read the Documentation
                                        <CIcon :icon="cilExternalLink" />
                                    </Button>

                                    <Button
                                        as="a"
                                        color="danger"
                                        href="https://laracasts.com"
                                        shape="rounded-pill"
                                        variant="outline"
                                        target="_blank"
                                    >
                                        Watch tutorials at Laracasts
                                        <CIcon :icon="cilExternalLink" />
                                    </Button>

                                    <Button
                                        as="a"
                                        color="light"
                                        href="https://cloud.laravel.com"
                                        shape="rounded-pill"
                                        target="_blank"
                                    >
                                        Deploy Now
                                    </Button>
                                </Column>
                            </Row>
                        </CardContent>
                    </Card>
                </Column>
            </Row>
        </Container>
    </div>
</template>
