<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { TabGroup, TabItem, TabList } from '@/components/ui/tab';
import { useAppearance } from '@/composables/useAppearance';
import { cn } from '@/lib/utils';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', icon: 'sun', label: 'Light' },
    { value: 'dark', icon: 'moon', label: 'Dark' },
    { value: 'system', icon: 'display', label: 'System' },
] as const;
</script>

<template>
    <TabGroup :activeItemKey="appearance">
        <TabList class="bg-body shadow-sm" variant="enclosed-pills">
            <TabItem
                v-for="{ value, icon, label } in tabs"
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
                <Icon :name="icon" />
                {{ label }}
            </TabItem>
        </TabList>
    </TabGroup>
</template>
