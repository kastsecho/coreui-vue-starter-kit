export type Shape =
    | 'rounded'
    | 'rounded-top'
    | 'rounded-end'
    | 'rounded-bottom'
    | 'rounded-start'
    | 'rounded-circle'
    | 'rounded-pill'
    | 'rounded-0'
    | 'rounded-1'
    | 'rounded-2'
    | 'rounded-3';

export type Align = '' | 'left' | 'center' | 'right';

export type Breakpoint = 'sm' | 'md' | 'lg' | 'xl' | 'xxl';

export type Color =
    | 'primary'
    | 'secondary'
    | 'success'
    | 'danger'
    | 'warning'
    | 'info'
    | 'dark'
    | 'light'
    | 'link'
    | 'transparent';

export type Container = Breakpoint | 'fluid';

export type Placement =
    | 'auto'
    | 'top-end'
    | 'top'
    | 'top-start'
    | 'bottom-end'
    | 'bottom'
    | 'bottom-start'
    | 'right-start'
    | 'right'
    | 'right-end'
    | 'left-start'
    | 'left'
    | 'left-end';

export type TextColor =
    | 'primary'
    | 'secondary'
    | 'success'
    | 'danger'
    | 'warning'
    | 'info'
    | 'dark'
    | 'light'
    | 'primary-emphasis'
    | 'secondary-emphasis'
    | 'success-emphasis'
    | 'danger-emphasis'
    | 'warning-emphasis'
    | 'info-emphasis'
    | 'light-emphasis'
    | 'body'
    | 'body-emphasis'
    | 'body-secondary'
    | 'body-tertiary'
    | 'black'
    | 'black-50'
    | 'white'
    | 'white-50';
