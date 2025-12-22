<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { FileText, Clock, CheckCircle2, AlertCircle, TrendingUp, BarChart3, Eye } from 'lucide-vue-next';
import ContractStatusChart from '@/components/charts/ContractStatusChart.vue';
import ContractTimelineChart from '@/components/charts/ContractTimelineChart.vue';
import ContractTypeChart from '@/components/charts/ContractTypeChart.vue';
import { useDashboardLayout } from '@/composables/useDashboardLayout';

const props = defineProps({
    stats: Object,
    recentContracts: Array,
    statusData: Object,
    timelineLabels: Array,
    timelineData: Array,
    typeLabels: Array,
    typeData: Array,
});

const { sections, isSectionVisible } = useDashboardLayout();

const getOrder = (id) => {
    const section = sections.value.find(s => s.id === id);
    return section ? section.order : 0;
};

const formatCurrency = (value) => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(value);
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('pt-BR');
};

const getStatusClass = (status) => {
    const classes = {
        'Ativo': 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
        'Pendente': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
        'Em Análise': 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
        'Suspenso': 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400',
        'Encerrado': 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    };
    return classes[status] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <template #header>
            <h2 class="text-3xl font-bold text-gradient">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-col gap-8">
                <!-- Stats Cards -->
                <div 
                    v-if="isSectionVisible('stats')"
                    :style="{ order: getOrder('stats') }"
                    class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4"
                >
                    <!-- Card 1: Contratos Ativos -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 p-6 text-white shadow-premium transition-all duration-300 hover:-translate-y-2 hover:shadow-premium-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-primary-100">Contratos Ativos</p>
                                <p class="mt-2 text-4xl font-bold">{{ stats?.active || 0 }}</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <FileText :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-primary-100">
                            <span class="font-semibold text-white">{{ stats?.total || 0 }}</span>
                            <span class="ml-2">contratos no total</span>
                        </div>
                    </div>

                    <!-- Card 2: Pendentes -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-100">Pendentes</p>
                                <p class="mt-2 text-4xl font-bold">{{ stats?.pending || 0 }}</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <Clock :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-yellow-100">
                            <span class="ml-0">Aguardando análise</span>
                        </div>
                    </div>

                    <!-- Card 3: Concluídos -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-accent-500 to-emerald-600 p-6 text-white shadow-accent transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-100">Encerrados</p>
                                <p class="mt-2 text-4xl font-bold">{{ stats?.completed || 0 }}</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <CheckCircle2 :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-100">
                            <span class="ml-0">Contratos finalizados</span>
                        </div>
                    </div>

                    <!-- Card 4: Vencendo em Breve -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-red-500 to-pink-600 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-100">Vencendo em 30 dias</p>
                                <p class="mt-2 text-4xl font-bold">{{ stats?.expiring || 0 }}</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <AlertCircle :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-red-100">
                            <span class="ml-0">Atenção necessária</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div 
                    v-if="isSectionVisible('quickActions')"
                    :style="{ order: getOrder('quickActions') }"
                    class="animate-slide-up overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 transition-all duration-300 hover:shadow-xl" 
                    style="animation-delay: 0.4s;"
                >
                    <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-secondary-50 dark:from-gray-800 dark:to-gray-800 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ações Rápidas</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <Link :href="route('contracts.create')" class="block w-full rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-3 text-left text-sm font-medium text-white shadow-md transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                                <div class="flex items-center gap-3">
                                    <FileText :size="20" />
                                    <span>Novo Contrato</span>
                                </div>
                            </Link>
                            <Link :href="route('contracts.index')" class="block w-full rounded-lg border-2 border-primary-200 dark:border-primary-700 bg-white dark:bg-gray-700 px-4 py-3 text-left text-sm font-medium text-primary-700 dark:text-primary-300 transition-all duration-200 hover:border-primary-300 hover:bg-primary-50 dark:hover:bg-gray-600">
                                <div class="flex items-center gap-3">
                                    <Clock :size="20" />
                                    <span>Revisar Pendentes</span>
                                </div>
                            </Link>
                            <Link :href="route('contracts.index')" class="block w-full rounded-lg border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-200 transition-all duration-200 hover:border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <div class="flex items-center gap-3">
                                    <AlertCircle :size="20" />
                                    <span>Ver Todos</span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Recent Contracts -->
                <div 
                    v-if="isSectionVisible('recentContracts')"
                    :style="{ order: getOrder('recentContracts') }"
                    class="animate-slide-up overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 transition-all duration-300 hover:shadow-xl" 
                    style="animation-delay: 0.5s;"
                >
                    <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-secondary-50 to-primary-50 dark:from-gray-800 dark:to-gray-800 px-6 py-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contratos Recentes</h3>
                        <Link :href="route('contracts.index')" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                            Ver todos
                        </Link>
                    </div>
                    <div v-if="!recentContracts || recentContracts.length === 0" class="p-12 text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                            <FileText :size="32" class="text-gray-400" />
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Nenhum contrato cadastrado</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Comece cadastrando seu primeiro contrato usando o botão "Novo Contrato" acima.</p>
                    </div>
                    <div v-else class="divide-y divide-gray-100 dark:divide-gray-700">
                        <div v-for="contract in recentContracts" :key="contract.id" class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-900/30">
                                        <FileText class="h-5 w-5 text-indigo-600 dark:text-indigo-400" />
                                    </div>
                                    <div>
                                        <p class="font-mono text-sm font-medium text-gray-900 dark:text-white">{{ contract.code }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ contract.title }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span :class="getStatusClass(contract.status)" class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium">
                                        {{ contract.status }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ formatCurrency(contract.total) }}</span>
                                    <Link :href="route('contracts.show', contract.id)" class="rounded p-1.5 text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                        <Eye class="h-4 w-4" />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div 
                    v-if="isSectionVisible('charts')"
                    :style="{ order: getOrder('charts') }"
                >
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 shadow-lg shadow-primary-500/30">
                            <BarChart3 :size="24" class="text-white" />
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Análise de Dados</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Visualize métricas e tendências dos seus contratos</p>
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-3">
                        <!-- Status Distribution Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.1s;">
                            <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                        <FileText :size="16" class="text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Distribuição por Status</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractStatusChart :data="statusData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ stats?.total > 0 ? 'Total: ' + stats.total + ' contratos' : 'Nenhum dado disponível' }}
                                </p>
                            </div>
                        </div>

                        <!-- Timeline Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.2s;">
                            <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-800 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                                        <TrendingUp :size="16" class="text-purple-600 dark:text-purple-400" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Evolução Temporal</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractTimelineChart :labels="timelineLabels" :data="timelineData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Últimos 6 meses
                                </p>
                            </div>
                        </div>

                        <!-- Type Distribution Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-900/5 dark:ring-gray-700 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.3s;">
                            <div class="border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-800 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                        <BarChart3 :size="16" class="text-emerald-600 dark:text-emerald-400" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Por Tipo de Contrato</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractTypeChart :labels="typeLabels" :data="typeData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Distribuição por categoria
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
