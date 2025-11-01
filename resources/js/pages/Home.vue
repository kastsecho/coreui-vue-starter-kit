<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardImage,
} from '@/components/ui/card';
import {
    ListGroup,
    ListGroupItem,
    ListGroupLink,
} from '@/components/ui/list-group';
import {
    NavigationMenu,
    NavigationMenuLink,
    NavigationMenuList,
} from '@/components/ui/navigation-menu';
import { dashboard, login, logout, register } from '@/routes';
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps<{
    canRegister: boolean;
    laravel?: string;
    php?: string;
}>();

const page = usePage();
const auth = page.props.auth;
</script>

<template>
    <Head title="Home" />

    <NavigationMenu container expand placement="fixed-top">
        <NavigationMenuList class="ms-auto align-items-center">
            <template v-if="auth.user">
                <NavigationMenuLink as="button" :href="logout()">
                    Log out
                </NavigationMenuLink>
                <Link class="btn btn-secondary" :href="dashboard()">
                    Dashboard
                </Link>
            </template>
            <template v-else>
                <NavigationMenuLink :href="login()">Log in</NavigationMenuLink>
                <Link
                    v-if="canRegister"
                    class="btn btn-secondary"
                    :href="register()"
                >
                    Register
                </Link>
            </template>
        </NavigationMenuList>
    </NavigationMenu>

    <CContainer
        class="d-grid align-items-center justify-content-center min-vh-100"
    >
        <CRow class="align-items-center row-gap-3 row-gap-md-0">
            <CCol md="7" lg="5">
                <Card class="rounded-4 shadow-sm">
                    <CardContent>
                        <h1 class="fs-3 fw-medium">Let's get started</h1>
                        <CardDescription>
                            Laravel has an incredibly rich ecosystem. <br />
                            We suggest starting with the following.
                        </CardDescription>

                        <ListGroup flush>
                            <ListGroupLink
                                as="a"
                                class="d-flex align-items-center gap-2"
                                href="https://coreui.io/vue/docs"
                                target="_blank"
                            >
                                <Icon color="secondary" name="record-circle" />
                                <span>
                                    Read the
                                    <span
                                        class="d-inline-flex text-danger text-decoration-underline gap-1"
                                    >
                                        <span>CoreUI Documentation</span>
                                        <Icon
                                            name="arrow-up-right-square-fill"
                                        />
                                    </span>
                                </span>
                            </ListGroupLink>
                            <ListGroupLink
                                as="a"
                                class="d-flex align-items-center gap-2 fw-medium"
                                href="https://laravel.com/docs"
                                target="_blank"
                            >
                                <Icon color="secondary" name="record-circle" />
                                <span>
                                    Read the
                                    <span
                                        class="d-inline-flex text-danger text-decoration-underline gap-1"
                                    >
                                        <span>Laravel Documentation</span>
                                        <Icon
                                            name="arrow-up-right-square-fill"
                                        />
                                    </span>
                                </span>
                            </ListGroupLink>
                            <ListGroupLink
                                as="a"
                                class="d-flex align-items-center gap-2 fw-medium"
                                href="https://laracasts.com"
                                target="_blank"
                            >
                                <Icon color="secondary" name="record-circle" />
                                <span>
                                    Watch video tutorials at
                                    <span
                                        class="d-inline-flex text-danger text-decoration-underline gap-1"
                                    >
                                        <span>Laracasts</span>
                                        <Icon
                                            name="arrow-up-right-square-fill"
                                        />
                                    </span>
                                </span>
                            </ListGroupLink>
                        </ListGroup>

                        <ListGroup flush>
                            <ListGroupItem>
                                <a
                                    href="https://cloud.laravel.com"
                                    target="_blank"
                                    class="btn btn-danger"
                                >
                                    Deploy now
                                </a>
                            </ListGroupItem>
                        </ListGroup>
                    </CardContent>
                </Card>
            </CCol>

            <CCol md="5" lg="7">
                <Card class="rounded-4 shadow-sm">
                    <CardImage
                        class="rounded-4 border border-secondary"
                        orientation="top"
                        src="/img/coreui-screenshot.jpg"
                        alt="Dashboard Preview"
                    />
                    <CardContent class="text-center">
                        <CardDescription class="small fw-medium">
                            Laravel v{{ laravel }} &mdash; PHP v{{ php }}
                        </CardDescription>
                    </CardContent>
                </Card>
            </CCol>
        </CRow>
    </CContainer>
</template>
