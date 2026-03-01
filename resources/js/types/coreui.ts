// Colors
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

export type BackgroundColor =
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

// Alignment
export type Alignment = 'start' | 'end';
type PlacementType = 'auto' | 'top' | 'bottom' | 'left' | 'right';
export type Placement =
    | PlacementType
    | `${Exclude<PlacementType, 'auto'>}-${Alignment}`;

export type Spacing = 1 | 2 | 3 | 4 | 5;

// Breakpoints
export type Breakpoint = 'sm' | 'md' | 'lg' | 'xl' | 'xxl';
export type Container = Breakpoint | 'fluid';

// Miscellaneous
type ShapeType =
    | 'top'
    | 'end'
    | 'bottom'
    | 'start'
    | 'circle'
    | 'pill'
    | '0'
    | '1'
    | '2'
    | '3';
export type Shape = 'rounded' | `rounded-${ShapeType}`;
