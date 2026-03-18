import type { CButton, CCard, CDropdown, CNavbar, CSidebar } from '@coreui/vue';

// Props
type ButtonProps = InstanceType<typeof CButton>['$props'];
type CardProps = InstanceType<typeof CCard>['$props'];
type DropdownProps = InstanceType<typeof CDropdown>['$props'];
type NavbarProps = InstanceType<typeof CNavbar>['$props'];
type SidebarProps = InstanceType<typeof CSidebar>['$props'];

// Shared Types
export type CShape = ButtonProps['shape'];

export type CColor = ButtonProps['color'];
export type CTextColor = CardProps['textColor'];
export type CBgColor =
    | Exclude<CColor, 'link' | 'transparent'>
    | 'body'
    | 'body-secondary'
    | 'body-tertiary'
    | 'black'
    | 'white';
export type CBgTextColor = CardProps['textBgColor'];

export type CContainer = NavbarProps['container'];
export type CExpand = NavbarProps['expand'];
export type CSpacing = 1 | 2 | 3 | 4 | 5;

// Component Types
export type CButtonSize = ButtonProps['size'];
export type CButtonVariant = ButtonProps['variant'];

export type CDropdownPlacement = DropdownProps['placement'];
export type CNavbarPlacement = NavbarProps['placement'];
export type CSidebarPlacement = SidebarProps['placement'];

export type CTableColumn = {
    key: string;
    label?: string;
    [key: string]: unknown;
};
