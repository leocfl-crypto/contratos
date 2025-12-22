<script setup lang="ts">
import { useFontSize } from '@/composables/useFontSize';
import { Type } from 'lucide-vue-next';

const { fontSize, changeFontSize } = useFontSize();

const sizes = [
    { value: 'small', label: 'Pequeno', size: 'text-xs' },
    { value: 'medium', label: 'Médio', size: 'text-sm' },
    { value: 'large', label: 'Grande', size: 'text-base' },
] as const;
</script>

<template>
    <div
        class="inline-flex gap-1 rounded-lg bg-neutral-100 dark:bg-neutral-800 p-1"
    >
        <button
            v-for="{ value, label, size } in sizes"
            :key="value"
            @click="changeFontSize(value)"
            :class="[
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                fontSize === value
                    ? 'bg-white dark:bg-neutral-700 shadow-xs dark:text-white'
                    : 'text-neutral-500 dark:text-neutral-400 hover:bg-neutral-200/60 dark:hover:bg-neutral-700/60 hover:text-black dark:hover:text-white',
            ]"
        >
            <Type class="-ml-1 h-4 w-4" />
            <span :class="['ml-1.5', size]">{{ label }}</span>
        </button>
    </div>
</template>
