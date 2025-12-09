<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { FileText, Clock, CheckCircle2, AlertCircle, TrendingUp, BarChart3 } from 'lucide-vue-next';
import ContractStatusChart from '@/components/charts/ContractStatusChart.vue';
import ContractTimelineChart from '@/components/charts/ContractTimelineChart.vue';
import ContractTypeChart from '@/components/charts/ContractTypeChart.vue';

// Dados mockados para os gráficos (substituir por dados reais do backend)
const statusData = {
    active: 0,
    pending: 0,
    completed: 0,
    expired: 0
};

const timelineLabels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'];
const timelineData = [0, 0, 0, 0, 0, 0];

const typeLabels = ['Tipo A', 'Tipo B', 'Tipo C'];
const typeData = [0, 0, 0];
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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Card 1: Contratos Ativos -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 p-6 text-white shadow-premium transition-all duration-300 hover:-translate-y-2 hover:shadow-premium-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-primary-100">Contratos Ativos</p>
                                <p class="mt-2 text-4xl font-bold">0</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <FileText :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-primary-100">
                            <span class="font-semibold text-white">-</span>
                            <span class="ml-2">Nenhum contrato cadastrado</span>
                        </div>
                    </div>

                    <!-- Card 2: Pendentes -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-100">Pendentes</p>
                                <p class="mt-2 text-4xl font-bold">0</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <Clock :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-yellow-100">
                            <span class="font-semibold text-white">-</span>
                            <span class="ml-2">Nenhum contrato cadastrado</span>
                        </div>
                    </div>

                    <!-- Card 3: Concluídos -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-accent-500 to-emerald-600 p-6 text-white shadow-accent transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-100">Concluídos</p>
                                <p class="mt-2 text-4xl font-bold">0</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <CheckCircle2 :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-100">
                            <span class="font-semibold text-white">-</span>
                            <span class="ml-2">Nenhum contrato cadastrado</span>
                        </div>
                    </div>

                    <!-- Card 4: Vencendo em Breve -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-red-500 to-pink-600 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-100">Vencendo em 30 dias</p>
                                <p class="mt-2 text-4xl font-bold">0</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <AlertCircle :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-red-100">
                            <span class="font-semibold text-white">-</span>
                            <span class="ml-2">Nenhum contrato cadastrado</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-8 grid gap-6 lg:grid-cols-3">
                    <div class="animate-slide-up overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.4s;">
                        <div class="border-b border-gray-200 bg-gradient-to-r from-primary-50 to-secondary-50 px-6 py-4">
                            <h3 class="text-lg font-semibold text-gray-900">Ações Rápidas</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <button class="w-full rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-3 text-left text-sm font-medium text-white shadow-md transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center gap-3">
                                        <FileText :size="20" />
                                        <span>Novo Contrato</span>
                                    </div>
                                </button>
                                <button class="w-full rounded-lg border-2 border-primary-200 bg-white px-4 py-3 text-left text-sm font-medium text-primary-700 transition-all duration-200 hover:border-primary-300 hover:bg-primary-50">
                                    <div class="flex items-center gap-3">
                                        <Clock :size="20" />
                                        <span>Revisar Pendentes</span>
                                    </div>
                                </button>
                                <button class="w-full rounded-lg border-2 border-gray-200 bg-white px-4 py-3 text-left text-sm font-medium text-gray-700 transition-all duration-200 hover:border-gray-300 hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <AlertCircle :size="20" />
                                        <span>Ver Alertas</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="animate-slide-up overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 transition-all duration-300 hover:shadow-xl lg:col-span-2" style="animation-delay: 0.5s;">
                        <div class="border-b border-gray-200 bg-gradient-to-r from-secondary-50 to-primary-50 px-6 py-4">
                            <h3 class="text-lg font-semibold text-gray-900">Contratos Recentes</h3>
                        </div>
                        <div class="p-12 text-center">
                            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                                <FileText :size="32" class="text-gray-400" />
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-gray-900">Nenhum contrato cadastrado</h3>
                            <p class="text-sm text-gray-600">Comece cadastrando seu primeiro contrato usando o botão "Novo Contrato" acima.</p>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="mb-8">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 shadow-lg shadow-primary-500/30">
                            <BarChart3 :size="24" class="text-white" />
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Análise de Dados</h2>
                            <p class="text-sm text-gray-600">Visualize métricas e tendências dos seus contratos</p>
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-3">
                        <!-- Status Distribution Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.1s;">
                            <div class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">
                                        <FileText :size="16" class="text-blue-600" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Distribuição por Status</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractStatusChart :data="statusData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500">
                                    Nenhum dado disponível
                                </p>
                            </div>
                        </div>

                        <!-- Timeline Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.2s;">
                            <div class="border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100">
                                        <TrendingUp :size="16" class="text-purple-600" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Evolução Temporal</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractTimelineChart :labels="timelineLabels" :data="timelineData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500">
                                    Últimos 6 meses
                                </p>
                            </div>
                        </div>

                        <!-- Type Distribution Chart -->
                        <div class="animate-slide-up overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 transition-all duration-300 hover:shadow-xl" style="animation-delay: 0.3s;">
                            <div class="border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100">
                                        <BarChart3 :size="16" class="text-emerald-600" />
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-900">Por Tipo de Contrato</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="h-64">
                                    <ContractTypeChart :labels="typeLabels" :data="typeData" />
                                </div>
                                <p class="mt-4 text-center text-sm text-gray-500">
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
