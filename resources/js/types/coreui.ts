export type BaseAlignment = 'start' | 'end';
type BasePlacement = 'auto' | 'top' | 'bottom' | 'left' | 'right';
type SpacingScale = 1 | 2 | 3 | 4 | 5;

export type Align = '' | 'left' | 'center' | 'right';
export type Breakpoint = 'sm' | 'md' | 'lg' | 'xl' | 'xxl';
export type Container = Breakpoint | 'fluid';
export type Placement =
    | BasePlacement
    | `${Exclude<BasePlacement, 'auto'>}-${BaseAlignment}`;
export type Spacing = SpacingScale | `${SpacingScale}`;

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

export type BgColor =
    | Exclude<Color, 'link' | 'transparent'>
    | 'body'
    | 'body-secondary'
    | 'body-tertiary'
    | 'black'
    | 'white';

export type TextColor =
    | Exclude<Color, 'link' | 'transparent'>
    | `${Exclude<Color, 'link' | 'transparent' | 'dark'>}-emphasis`
    | 'body'
    | 'body-emphasis'
    | 'body-secondary'
    | 'body-tertiary'
    | 'black'
    | 'black-50'
    | 'white'
    | 'white-50';

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
