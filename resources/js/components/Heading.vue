<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Undo2 } from 'lucide-vue-next';
import Button from './ui/button/Button.vue';

interface Props {
    title: string;
    description?: string;
    backUrl?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <div class="flex items-center gap-2">
            <Link v-if="backUrl" :href="backUrl">
                <Button>
                    <Undo2 class="h-5 w-5" />
                </Button>
            </Link>
            <h2 class="text-xl font-semibold tracking-tight">{{ title }}</h2>
        </div>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
    </div>
</template>
