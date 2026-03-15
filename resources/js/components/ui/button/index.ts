import type {
    CButtonSize,
    CButtonVariant,
    CColor,
    CShape,
} from '@/types';

export { default as Button } from './Button.vue';
export { default as ButtonGroup } from './ButtonGroup.vue';

export type ButtonVariants = {
    color?: CColor;
    shape?: CShape;
    size?: CButtonSize;
    variant?: CButtonVariant;
};
