<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { CButton, CButtonGroup, CFormCheck } from '@coreui/vue';
const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: 'bi-sun-fill', label: 'Light' },
    { value: 'dark', Icon: 'bi-moon-fill', label: 'Dark' },
    { value: 'auto', Icon: 'bi-display', label: 'System' },
] as const;
</script>

<template>
    <div>
        <CButtonGroup class="bg-body border rounded-3 shadow-sm" role="group">
            <template v-for="{ value, Icon, label } in tabs" :key="value">
                <CFormCheck
                    :id="value"
                    type="radio"
                    :button="{}"
                    name="appearance"
                    :checked="appearance === value"
                    @click="updateAppearance(value)"
                />
                <CButton
                    as="label"
                    color="primary"
                    variant="outline"
                    class="rounded-3"
                    :class="[appearance === value ? '' : 'border-0']"
                    :for="value"
                >
                    <span :class="Icon"></span>
                    <span class="ms-2">{{ label }}</span>
                </CButton>
            </template>
        </CButtonGroup>
    </div>
</template>
