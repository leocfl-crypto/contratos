<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import FontSizeTabs from '@/components/FontSizeTabs.vue';
import DashboardLayoutOrganizer from '@/components/DashboardLayoutOrganizer.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';


import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/settings/appearance';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Configurações de Aparência',
        href: edit().url,
    },
];
</script>

<template>
    <Head title="Configurações de Aparência" />

    <SettingsLayout :breadcrumbs="breadcrumbItems">
            <div class="space-y-6">
                <HeadingSmall
                    title="Configurações de Aparência"
                    description="Atualize as configurações de aparência da sua conta"
                />
                
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tema</h4>
                        <AppearanceTabs />
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tamanho da Fonte</h4>
                        <FontSizeTabs />
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Layout do Dashboard</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Escolha quais seções exibir e em qual ordem</p>
                        <DashboardLayoutOrganizer />
                    </div>
                </div>
            </div>
    </SettingsLayout>
</template>
