<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { Button, ButtonGroup } from '@/components/ui/button';
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', icon: 'sun', label: 'Light' },
    { value: 'dark', icon: 'moon', label: 'Dark' },
    { value: 'system', icon: 'display', label: 'System' },
] as const;
</script>

<template>
    <ButtonGroup class="bg-body rounded-4 shadow-sm">
        <Button
            v-for="{ value, icon, label } in tabs"
            :key="value"
            class="rounded-4"
            :class="{ 'shadow-sm': appearance === value }"
            :color="appearance === value ? 'primary' : 'transparent'"
            @click="updateAppearance(value)"
            :active="appearance === value"
        >
            <Icon :name="icon" />
            <span class="ms-2">{{ label }}</span>
        </Button>
    </ButtonGroup>
</template>
