<script setup lang="ts">
import { CSidebarFooter } from '@coreui/vue';
import { type HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
    <CSidebarFooter
        data-slot="sidebar-footer"
        data-sidebar="footer"
        :class="cn('border-top d-none d-lg-flex', props.class)"
    >
        <slot />
    </CSidebarFooter>
</template>
