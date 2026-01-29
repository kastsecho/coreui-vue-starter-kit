<script setup lang="ts">
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardTitle,
} from '@/components/ui/card';
import { Spinner } from '@/components/ui/spinner';

const props = defineProps<{
    exception?: string;
    responseStart: number;
    responseEnd: number;
}>();

const responseTime = computed(() =>
    Math.round((props.responseEnd - props.responseStart) * 1000),
);

const statusColor = computed(() => (props.exception ? 'danger' : 'success'));
</script>

<template>
    <Head title="Health" />

    <CContainer class="d-grid align-items-center min-vh-100">
        <CRow class="justify-content-center">
            <CCol md="8" lg="6">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center gap-4">
                        <Spinner
                            :color="statusColor"
                            variant="grow"
                            style="--cui-spinner-animation-speed: 1.8s"
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
