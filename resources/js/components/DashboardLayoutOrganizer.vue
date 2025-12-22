<script setup lang="ts">
import { useDashboardLayout } from '@/composables/useDashboardLayout';
import { Eye, EyeOff, ChevronUp, ChevronDown, RotateCcw } from 'lucide-vue-next';

const { sections, toggleSection, moveUp, moveDown, resetToDefault } = useDashboardLayout();
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs text-gray-500 dark:text-gray-400">Arraste ou use as setas para reorganizar</span>
            <button
                @click="resetToDefault"
                class="flex items-center gap-1 text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors"
            >
                <RotateCcw class="h-3 w-3" />
                Restaurar padrão
            </button>
        </div>
        
        <div
            v-for="(section, index) in sections"
            :key="section.id"
            class="flex items-center gap-3 p-3 rounded-lg bg-neutral-100 dark:bg-neutral-800 transition-all"
        >
            <!-- Visibility Toggle -->
            <button
                @click="toggleSection(section.id)"
                :class="[
                    'p-1.5 rounded-md transition-colors',
                    section.visible 
                        ? 'text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-primary-900/30' 
                        : 'text-gray-400 dark:text-gray-500 bg-gray-200 dark:bg-gray-700'
                ]"
                :title="section.visible ? 'Ocultar seção' : 'Mostrar seção'"
            >
                <Eye v-if="section.visible" class="h-4 w-4" />
                <EyeOff v-else class="h-4 w-4" />
            </button>
            
            <!-- Section Name -->
            <span 
                :class="[
                    'flex-1 text-sm font-medium transition-colors',
                    section.visible 
                        ? 'text-gray-900 dark:text-gray-100' 
                        : 'text-gray-400 dark:text-gray-500 line-through'
                ]"
            >
                {{ section.label }}
            </span>
            
            <!-- Order Controls -->
            <div class="flex items-center gap-1">
                <button
                    @click="moveUp(section.id)"
                    :disabled="index === 0"
                    :class="[
                        'p-1 rounded transition-colors',
                        index === 0 
                            ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' 
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'
                    ]"
                    title="Mover para cima"
                >
                    <ChevronUp class="h-4 w-4" />
                </button>
                <button
                    @click="moveDown(section.id)"
                    :disabled="index === sections.length - 1"
                    :class="[
                        'p-1 rounded transition-colors',
                        index === sections.length - 1 
                            ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' 
                            : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'
                    ]"
                    title="Mover para baixo"
                >
                    <ChevronDown class="h-4 w-4" />
                </button>
            </div>
        </div>
    </div>
</template>
