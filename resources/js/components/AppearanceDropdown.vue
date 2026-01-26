<script setup lang="ts">
import { computed, type HTMLAttributes } from 'vue';
import Icon from '@/components/Icon.vue';
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
    { value: 'light', icon: 'sun', label: 'Light' },
    { value: 'dark', icon: 'moon', label: 'Dark' },
    { value: 'system', icon: 'display', label: 'System' },
] as const;

const active = computed(() =>
    tabs.find((tab) => tab.value === appearance.value),
);
</script>

<template>
    <DropdownMenu align="end" variant="nav-item">
        <DropdownMenuTrigger class="nav-link" :caret="false">
            <Icon :class="iconClass" :name="active?.icon!" />
            <span class="visually-hidden">
                {{ active?.label }}
            </span>
        </DropdownMenuTrigger>

        <DropdownMenuContent>
            <DropdownMenuLabel class="py-0 fw-medium">
                Appearance
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem
                v-for="{ value, icon, label } in tabs"
                :key="value"
                class="icon-link"
                as="button"
                @click="updateAppearance(value)"
                :active="appearance === value"
            >
                <Icon :name="icon" />
                <span>{{ label }}</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
