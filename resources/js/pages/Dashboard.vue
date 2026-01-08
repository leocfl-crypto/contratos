<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { 
    FileText, 
    Clock, 
    CheckCircle2, 
    AlertCircle, 
    TrendingUp, 
    BarChart3, 
    Eye,
    Plus,
    ArrowRight,
    Search,
    LayoutDashboard,
    Calendar,
    Briefcase
} from 'lucide-vue-next';
import ContractStatusChart from '@/components/charts/ContractStatusChart.vue';
import ContractTimelineChart from '@/components/charts/ContractTimelineChart.vue';
import ContractTypeChart from '@/components/charts/ContractTypeChart.vue';

const page = usePage();
const user = page.props.auth?.user;

const props = defineProps({
    stats: Object,
    recentContracts: Array,
    statusData: Object,
    timelineLabels: Array,
    timelineData: Array,
    typeLabels: Array,
    typeData: Array,
});

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
        'Ativo': 'badge-success',
        'Pendente': 'badge-warning',
        'Em Análise': 'badge-primary',
        'Suspenso': 'bg-orange-100 text-orange-800',
        'Encerrado': 'bg-gray-100 text-gray-800',
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="space-y-8 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
            

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Ativos Card -->
                <div class="group relative overflow-hidden rounded-2xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-slide-up">
                    <div class="flex items-center justify-between">
                        <div class="p-3 rounded-xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <FileText :size="24" />
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Ativos</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ stats?.active || 0 }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Total de {{ stats?.total || 0 }} contratos</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-semibold text-blue-600">
                        <span>Ver detalhes</span>
                        <ArrowRight :size="14" class="ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" />
                    </div>
                </div>

                <!-- Pendentes Card -->
                <div class="group relative overflow-hidden rounded-2xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="flex items-center justify-between">
                        <div class="p-3 rounded-xl bg-amber-50 text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <Clock :size="24" />
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Pendentes</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ stats?.pending || 0 }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Aguardando análise</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-semibold text-amber-600">
                        <span>Ações necessárias</span>
                        <ArrowRight :size="14" class="ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" />
                    </div>
                </div>

                <!-- Encerrados Card -->
                <div class="group relative overflow-hidden rounded-2xl bg-white p-6 shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-between">
                        <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <CheckCircle2 :size="24" />
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Encerrados</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ stats?.completed || 0 }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Contratos finalizados</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-semibold text-emerald-600">
                        <span>Ver histórico</span>
                        <ArrowRight :size="14" class="ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" />
                    </div>
                </div>

                <!-- Críticos Card -->
                <div class="group relative overflow-hidden rounded-2xl bg-red-50 p-6 shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between">
                        <div class="p-3 rounded-xl bg-red-100 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                            <AlertCircle :size="24" />
                        </div>
                        <span class="text-xs font-bold text-red-400 uppercase tracking-widest">Próximos do Fim</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-3xl font-extrabold text-red-700">{{ stats?.expiring || 0 }}</h3>
                        <p class="text-sm text-red-600 mt-1">Vencem em 30 dias</p>
                    </div>
                    <div class="mt-6 flex items-center text-xs font-semibold text-red-600">
                        <span>Renovar agora</span>
                        <ArrowRight :size="14" class="ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" />
                    </div>
                </div>
            </div>

            <!-- Content Grid: Recent Contracts & Charts Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Recent Contracts Column -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-primary-100 text-primary-600">
                                <FileText :size="20" />
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Contratos Recentes</h2>
                        </div>
                        <Link :href="route('contracts.index')" class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                            Ver todos
                            <ArrowRight :size="14" />
                        </Link>
                    </div>

                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                        <div v-if="!recentContracts || recentContracts.length === 0" class="p-12 text-center">
                            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-50 border-2 border-dashed border-gray-200">
                                <FileText :size="32" class="text-gray-300" />
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Nenhum contrato</h3>
                            <p class="text-sm text-gray-500 mt-1 max-w-xs mx-auto">Sua lista está vazia. Comece criando um novo contrato.</p>
                        </div>
                        <div v-else class="divide-y divide-gray-50">
                            <div v-for="contract in recentContracts" :key="contract.id" class="group flex items-center justify-between p-4 hover:bg-gray-50 transition-all transition-duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="hidden sm:flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                        <Briefcase :size="22" />
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 truncate max-w-[200px] sm:max-w-xs">{{ contract.title }}</h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="font-mono text-[11px] font-bold text-gray-400 bg-gray-50 px-1.5 py-0.5 rounded">{{ contract.code }}</span>
                                            <span class="text-xs text-gray-400">•</span>
                                            <span class="text-xs text-gray-500">{{ formatDate(contract.created_at) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="hidden md:block text-right">
                                        <p class="text-sm font-bold text-gray-900">{{ formatCurrency(contract.total) }}</p>
                                        <p class="text-[11px] text-gray-400 uppercase tracking-tighter">Valor Total</p>
                                    </div>
                                    <span :class="getStatusClass(contract.status)" class="badge text-[10px] uppercase font-bold py-1 px-2.5">
                                        {{ contract.status }}
                                    </span>
                                    <Link :href="route('contracts.show', contract.id)" class="p-2 rounded-lg text-gray-400 hover:bg-white hover:text-primary-600 hover:shadow-sm border border-transparent hover:border-gray-100 transition-all">
                                        <Eye :size="18" />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Temporal Evolution Chart -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-2">
                                <div class="p-1.5 rounded-lg bg-purple-50 text-purple-600">
                                    <TrendingUp :size="18" />
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Evolução Temporal</h3>
                            </div>
                            <span class="text-xs font-semibold text-gray-400">Últimos 6 meses</span>
                        </div>
                        <div class="h-[280px]">
                            <ContractTimelineChart :labels="timelineLabels" :data="timelineData" />
                        </div>
                    </div>
                </div>

                <!-- Sidebar Analytics Column -->
                <div class="space-y-6">
                    
                    <!-- Quick Actions Card -->
                    <div class="rounded-2xl bg-white p-6 shadow-md border border-gray-100 animate-slide-in-right">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Atalho Rápido</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <Link :href="route('contracts.create')" class="flex flex-col items-center justify-center p-4 rounded-xl bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white transition-all group">
                                <Plus :size="24" class="mb-2" />
                                <span class="text-[11px] font-bold uppercase">Novo</span>
                            </Link>
                            <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-secondary-50 text-secondary-600 hover:bg-secondary-600 hover:text-white transition-all group">
                                <Calendar :size="24" class="mb-2" />
                                <span class="text-[11px] font-bold uppercase">Agenda</span>
                            </button>
                            <Link :href="route('ferias.index')" class="flex flex-col items-center justify-center p-4 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition-all group">
                                <LayoutDashboard :size="24" class="mb-2" />
                                <span class="text-[11px] font-bold uppercase">Férias</span>
                            </Link>
                            <Link :href="route('patrimonios.index')" class="flex flex-col items-center justify-center p-4 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all group">
                                <Briefcase :size="24" class="mb-2" />
                                <span class="text-[11px] font-bold uppercase">Bens</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Status Pie Chart -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-slide-in-right" style="animation-delay: 0.1s;">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="p-1.5 rounded-lg bg-blue-50 text-blue-600">
                                <BarChart3 :size="18" />
                            </div>
                            <h3 class="text-base font-bold text-gray-900">Distribuição</h3>
                        </div>
                        <div class="h-64">
                            <ContractStatusChart :data="statusData" />
                        </div>
                    </div>

                    <!-- Type Distribution Chart -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 animate-slide-in-right" style="animation-delay: 0.2s;">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600">
                                <Briefcase :size="18" />
                            </div>
                            <h3 class="text-base font-bold text-gray-900">Tipos de Contrato</h3>
                        </div>
                        <div class="h-64">
                            <ContractTypeChart :labels="typeLabels" :data="typeData" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn {
    @apply inline-flex items-center justify-center gap-2 transition-all duration-200;
}
</style>
