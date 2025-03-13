<script setup lang="ts">
import type { SharedData } from '@/types';
import { CFooter } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage<SharedData>();

const currentDate = ref(new Date());
</script>

<template>
    <CFooter class="px-4 bg-body">
        <div>
            <span class="me-1">&copy;</span>
            <Link :href="route('home')">
                {{ page.props.name }}
            </Link>
            <span class="ms-1">{{ currentDate.getFullYear() }}. All rights reserved.</span>
        </div>
        <div class="ms-auto">
            <span class="me-1">Powered by</span>
            <a href="https://coreui.io/vue" target="_blank">CoreUI for Vue</a>
        </div>
    </CFooter>
</template>
