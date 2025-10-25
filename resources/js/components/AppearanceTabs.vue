<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import { Button, ButtonGroup } from '@/components/ui/button';
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: 'sun', label: 'Light' },
    { value: 'dark', Icon: 'moon', label: 'Dark' },
    { value: 'system', Icon: 'display', label: 'System' },
] as const;
</script>

<template>
    <ButtonGroup class="bg-body rounded-4 shadow-sm">
        <Button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            class="rounded-4"
            :class="{'shadow-sm' : appearance === value}"
            :color="appearance === value ? 'primary' : 'transparent'"
            @click="updateAppearance(value)"
            :active="appearance === value"
        >
            <Icon :name="Icon" />
            <span class="ms-2">{{ label }}</span>
        </Button>
    </ButtonGroup>
</template>
