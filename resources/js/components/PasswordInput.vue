<script setup lang="ts">
import { ref, useTemplateRef } from 'vue';
import type { HTMLAttributes } from 'vue';
import Icon from '@/components/Icon.vue';
import { Button } from '@/components/ui/button';
import { Input, InputGroup } from '@/components/ui/input';

defineOptions({ inheritAttrs: false });

const props = defineProps<{
    invalid?: boolean;
    class?: HTMLAttributes['class'];
}>();

const showPassword = ref(false);
const inputRef = useTemplateRef('inputRef');

defineExpose({
    $el: inputRef,
    focus: () => inputRef.value?.$el?.focus(),
});
</script>

<template>
    <InputGroup :class="{ ['is-invalid']: invalid }">
        <Input
            ref="inputRef"
            :type="showPassword ? 'text' : 'password'"
            :class="props.class"
            v-bind="$attrs"
            :invalid="invalid"
        />
        <Button
            type="button"
            color="secondary"
            @click="showPassword = !showPassword"
            :aria-label="showPassword ? 'Hide password' : 'Show password'"
            :tabindex="-1"
        >
            <Icon v-if="showPassword" color="dark" name="eye-slash-fill" />
            <Icon v-else color="dark" name="eye-fill" />
        </Button>
    </InputGroup>
</template>
