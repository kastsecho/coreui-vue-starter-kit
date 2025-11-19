<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardTitle,
} from '@/components/ui/card';
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    exception?: string;
    responseStart: number;
    responseEnd: number;
}>();

const responseTime = computed(() =>
    Math.round((props.responseEnd - props.responseStart) * 1000),
);

const statusClass = computed(() =>
    props.exception ? 'text-danger' : 'text-success',
);
</script>

<template>
    <Head title="Status" />

    <CContainer class="d-grid align-items-center min-vh-100">
        <CRow class="justify-content-center">
            <CCol md="7" lg="5">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center gap-4">
                        <Icon
                            :class="['fs-5 icon-pulse', statusClass]"
                            name="record-circle"
                        />
                        <div>
                            <CardTitle>
                                Application
                                {{ exception ? 'experiencing problems' : 'up' }}
                            </CardTitle>

                            <CardDescription>
                                HTTP request received. Response rendered in
                                {{ responseTime }} ms.
                            </CardDescription>
                        </div>
                    </CardContent>
                </Card>
            </CCol>
        </CRow>
    </CContainer>
</template>
