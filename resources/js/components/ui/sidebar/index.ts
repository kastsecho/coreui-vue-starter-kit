import type { HTMLAttributes } from 'vue';
import type { Alignment, ResolvedAppearance } from '@/types';

export type SidebarProps = {
    colorScheme?: ResolvedAppearance;
    narrow?: boolean;
    overlaid?: boolean;
    placement?: Alignment;
    position?: 'fixed';
    size?: 'sm' | 'lg' | 'xl';
    class?: HTMLAttributes['class'];
};

export { default as Sidebar } from './Sidebar.vue';
export { default as SidebarContent } from './SidebarContent.vue';
export { default as SidebarFooter } from './SidebarFooter.vue';
export { default as SidebarGroup } from './SidebarGroup.vue';
export { default as SidebarGroupLabel } from './SidebarGroupLabel.vue';
export { default as SidebarHeader } from './SidebarHeader.vue';
export { default as SidebarHeaderList } from './SidebarHeaderList.vue'
export { default as SidebarInset } from './SidebarInset.vue';
export { default as SidebarMenuButton } from './SidebarMenuButton.vue'
export { default as SidebarMenuHeader } from './SidebarMenuHeader.vue';
export { default as SidebarMenuItem } from './SidebarMenuItem.vue';
export { default as SidebarMenuLink } from './SidebarMenuLink.vue';
export { default as SidebarRail } from './SidebarRail.vue';
export { default as SidebarTrigger } from './SidebarTrigger.vue';

export { useSidebar } from './utils';
