<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { Card, CardContent } from '@/components/ui/card';
import {
    NavigationMenu,
    NavigationMenuLink,
    NavigationMenuList,
} from '@/components/ui/navigation-menu';
import { dashboard, login, logout, register } from '@/routes';
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps<{
    canRegister: boolean;
}>();

const page = usePage();
const auth = page.props.auth;
</script>

<template>
    <Head title="Home" />

    <NavigationMenu container expand>
        <NavigationMenuList class="ms-auto align-items-center">
            <template v-if="auth.user">
                <NavigationMenuLink as="button" :href="logout()"
                    >Log out</NavigationMenuLink
                >
                <Link class="btn btn-outline-light" :href="dashboard()"
                    >Dashboard</Link
                >
            </template>
            <template v-else>
                <NavigationMenuLink :href="login()">Log in</NavigationMenuLink>
                <Link
                    v-if="canRegister"
                    class="btn btn-outline-light"
                    :href="register()"
                    >Register</Link
                >
            </template>
        </NavigationMenuList>
    </NavigationMenu>

    <div class="py-4 container">
        <Card class="rounded-4 shadow-sm">
            <CardContent class="px-4">
                <h1 class="fs-3 fw-medium">Let's get started</h1>
                <p class="text-muted">
                    Laravel has an incredibly rich ecosystem. <br />We suggest
                    starting with the following.
                </p>
                <ul class="mb-3 list-unstyled">
                    <li class="d-flex align-items-center gap-2">
                        <Icon color="secondary" name="record-circle" />
                        <span>
                            Read the
                            <a
                                href="https://coreui.io/bootstrap/docs"
                                target="_blank"
                                class="d-inline-flex link-danger gap-1"
                            >
                                <span>CoreUI Documentation</span>
                                <Icon name="arrow-up-right-square-fill" />
                            </a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <Icon color="secondary" name="record-circle" />
                        <span>
                            Read the
                            <a
                                href="https://laravel.com/docs"
                                target="_blank"
                                class="d-inline-flex link-danger gap-1"
                            >
                                <span>Laravel Documentation</span>
                                <Icon name="arrow-up-right-square-fill" />
                            </a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <Icon color="secondary" name="record-circle" />
                        <span>
                            Watch video tutorials at
                            <a
                                href="https://laracasts.com"
                                target="_blank"
                                class="d-inline-flex link-danger gap-1"
                            >
                                <span>Laracasts</span>
                                <Icon name="arrow-up-right-square-fill" />
                            </a>
                        </span>
                    </li>
                </ul>
                <ul class="mb-0 list-unstyled">
                    <li>
                        <a
                            href="https://cloud.laravel.com"
                            target="_blank"
                            class="btn btn-light"
                        >
                            Deploy now
                        </a>
                    </li>
                </ul>
            </CardContent>
        </Card>
    </div>
</template>
