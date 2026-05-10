<script setup lang="ts">
import { cilContrast, cilMoon, cilSun } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { TabGroup, TabItem, TabList } from '@/components/ui/tab';
import { useAppearance } from '@/composables/useAppearance';
import { cn } from '@/lib/utils';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: cilSun, label: 'Light' },
    { value: 'dark', Icon: cilMoon, label: 'Dark' },
    { value: 'system', Icon: cilContrast, label: 'System' },
] as const;
</script>

<template>
    <TabGroup :activeItemKey="appearance">
        <TabList class="bg-body shadow-sm" variant="enclosed-pills">
            <TabItem
                v-for="{ value, Icon, label } in tabs"
                :key="value"
                :class="
                    cn(
                        { 'text-bg-primary': appearance === value },
                        'd-flex align-items-center gap-2',
                    )
                "
                :itemKey="value"
                @focus="updateAppearance(value)"
            >
                <CIcon :icon="Icon" />
                {{ label }}
            </TabItem>
        </TabList>
    </TabGroup>
</template>
