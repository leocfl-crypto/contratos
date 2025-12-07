<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { FileText, Clock, CheckCircle2, AlertCircle } from 'lucide-vue-next';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
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
                                <p class="mt-2 text-4xl font-bold">24</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <FileText :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-primary-100">
                            <span class="font-semibold text-white">+12%</span>
                            <span class="ml-2">vs. mês anterior</span>
                        </div>
                    </div>

                    <!-- Card 2: Pendentes -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-100">Pendentes</p>
                                <p class="mt-2 text-4xl font-bold">8</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <Clock :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-yellow-100">
                            <span class="font-semibold text-white">-5%</span>
                            <span class="ml-2">vs. mês anterior</span>
                        </div>
                    </div>

                    <!-- Card 3: Concluídos -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-accent-500 to-emerald-600 p-6 text-white shadow-accent transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-100">Concluídos</p>
                                <p class="mt-2 text-4xl font-bold">156</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <CheckCircle2 :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-100">
                            <span class="font-semibold text-white">+18%</span>
                            <span class="ml-2">vs. mês anterior</span>
                        </div>
                    </div>

                    <!-- Card 4: Vencendo em Breve -->
                    <div class="group animate-slide-up rounded-2xl bg-gradient-to-br from-red-500 to-pink-600 p-6 text-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-100">Vencendo em 30 dias</p>
                                <p class="mt-2 text-4xl font-bold">5</p>
                            </div>
                            <div class="rounded-xl bg-white/20 p-3 backdrop-blur-sm">
                                <AlertCircle :size="32" class="text-white" />
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-red-100">
                            <span class="font-semibold text-white">2 críticos</span>
                            <span class="ml-2">requerem atenção</span>
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
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Contrato</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cliente</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Contrato de Serviços TI</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Empresa XYZ Ltda</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Ativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">15/06/2026</td>
                                    </tr>
                                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Locação de Equipamentos</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">ABC Corp</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Pendente</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">22/03/2025</td>
                                    </tr>
                                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Consultoria Empresarial</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Global Solutions</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Ativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">30/12/2025</td>
                                    </tr>
                                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Prestação de Serviços</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Tech Innovations</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Vencendo</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">05/01/2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
