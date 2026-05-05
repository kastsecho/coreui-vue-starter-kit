<script setup lang="ts">
import { CIconSvg } from '@coreui/icons-vue';
import { ref, useAttrs, useTemplateRef } from 'vue';
import type { HTMLAttributes } from 'vue';
import { biEye, biEyeSlash } from '@/components/icon';
import { Button } from '@/components/ui/button';
import { Input, InputGroup } from '@/components/ui/form';

defineOptions({ inheritAttrs: false });

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const attrs = useAttrs();

const showPassword = ref(false);
const inputRef = useTemplateRef('inputRef');

defineExpose({
    $el: inputRef,
    focus: () => inputRef.value?.$el?.focus(),
});
</script>

<template>
    <InputGroup :class="{ ['is-invalid']: attrs.invalid }">
        <Input
            ref="inputRef"
            v-bind="$attrs"
            :type="showPassword ? 'text' : 'password'"
            :class="props.class"
        />
        <Button
            type="button"
            class="border"
            color="light"
            :aria-label="showPassword ? 'Hide password' : 'Show password'"
            :tabindex="-1"
            @click="showPassword = !showPassword"
        >
            <CIconSvg>
                <biEyeSlash v-if="showPassword" />
                <biEye v-else />
            </CIconSvg>
        </Button>
    </InputGroup>
</template>
