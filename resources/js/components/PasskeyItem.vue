<script setup lang="ts">
import { CIconSvg, CIcon } from '@coreui/icons-vue';
import { ref } from 'vue';
import biKey from '@/components/icon/biKey.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogHeader,
    DialogDescription,
    DialogFooter,
    DialogTitle,
} from '@/components/ui/dialog';
import { ListGroupItem } from '@/components/ui/list-group';
import { cilTrash } from '@/icons';
import type { Passkey } from '@/types/auth';

const props = defineProps<{
    passkey: Passkey;
}>();

const emit = defineEmits<{
    remove: [id: number, onError: () => void];
}>();

const showDeleteModal = ref(false);
const isDeleting = ref(false);

const handleDelete = () => {
    isDeleting.value = true;
    emit('remove', props.passkey.id, () => {
        isDeleting.value = false;
    });
};
</script>

<template>
    <ListGroupItem class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <CIconSvg
                custom-class-name="bg-body-tertiary border text-muted p-2 rounded-4 icon icon-3xl"
            >
                <biKey />
            </CIconSvg>

            <div class="d-flex flex-column gap-1">
                <div class="d-flex align-items-center gap-3">
                    <p class="fw-medium mb-0">{{ passkey.name }}</p>
                    <Badge
                        v-if="passkey.authenticator"
                        class="border"
                        text-bg-color="light"
                    >
                        {{ passkey.authenticator }}
                    </Badge>
                </div>
                <p class="text-muted mb-0">
                    Added {{ passkey.created_at_diff }}
                    <template v-if="passkey.last_used_at_diff">
                        <span class="text-muted mx-1 opacity-50">/</span>
                        Last used {{ passkey.last_used_at_diff }}
                    </template>
                </p>
            </div>
        </div>

        <Button
            color="danger"
            variant="ghost"
            size="sm"
            @click="showDeleteModal = true"
        >
            <CIcon :icon="cilTrash"></CIcon>
            <span class="visually-hidden">Remove</span>
        </Button>
    </ListGroupItem>

    <Dialog
        content-class-name="rounded-4"
        :open="showDeleteModal"
        @close="showDeleteModal = false"
    >
        <DialogHeader class="d-grid" :close-button="false">
            <DialogTitle>Remove passkey</DialogTitle>
            <DialogDescription text-color="body-secondary">
                Are you sure you want to remove the "{{ passkey.name }}"
                passkey? You will no longer be able to use it to sign in.
            </DialogDescription>
        </DialogHeader>
        <DialogFooter class="gap-2">
            <Button color="secondary" @click="showDeleteModal = false">
                Cancel
            </Button>
            <Button color="danger" :disabled="isDeleting" @click="handleDelete">
                {{ isDeleting ? 'Removing...' : 'Remove passkey' }}
            </Button>
        </DialogFooter>
    </Dialog>
</template>
