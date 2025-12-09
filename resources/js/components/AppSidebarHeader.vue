<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import type { BreadcrumbItemType } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-sidebar-border/70 px-6 pr-20 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4 md:pr-16"
    >
        <div class="flex items-center gap-2 flex-1 min-w-0">
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <!-- Spacer para evitar sobreposição de ícones de extensões do navegador -->
        <div class="flex-shrink-0 w-12"></div>
    </header>
</template>
