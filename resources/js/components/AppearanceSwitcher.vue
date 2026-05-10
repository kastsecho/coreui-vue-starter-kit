<script setup lang="ts">
import { cilContrast, cilMoon, cilSun } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { computed } from 'vue';
import type { HTMLAttributes } from 'vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { useAppearance } from '@/composables/useAppearance';

defineProps<{
    iconClass?: HTMLAttributes['class'];
}>();

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: cilSun, label: 'Light' },
    { value: 'dark', Icon: cilMoon, label: 'Dark' },
    { value: 'system', Icon: cilContrast, label: 'System' },
] as const;

const active = computed(() =>
    tabs.find((tab) => tab.value === appearance.value),
);
</script>

<template>
    <DropdownMenu :alignment="{ md: 'end' }" variant="nav-item">
        <DropdownMenuTrigger class="pb-md-0 nav-link" :caret="false">
            <CIcon class="nav-icon my-0" :icon="active?.Icon" size="xl" />
            <span class="visually-hidden">
                {{ active?.label }}
            </span>
        </DropdownMenuTrigger>

        <DropdownMenuContent class="rounded-4 min-w-50 overflow-x-hidden">
            <DropdownMenuLabel class="fw-medium py-0">
                Appearance
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem
                v-for="{ value, Icon, label } in tabs"
                :key="value"
                class="icon-link"
                as="button"
                @click="updateAppearance(value)"
                :active="appearance === value"
            >
                <CIcon class="nav-icon me-2" :icon="Icon" />
                <span>{{ label }}</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
