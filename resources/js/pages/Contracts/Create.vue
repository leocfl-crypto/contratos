<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import { Input } from '@/components/ui/input';
import { computed } from 'vue';

const props = defineProps({
    suppliers: Array,
    contractTypes: Array,
    nextCode: String,
    statusOptions: Array,
});

const form = useForm({
    code: '',
    title: '',
    description: '',
    supplier_id: '',
    contract_type_id: '',
    status: 'Pendente',
    start_date: '',
    end_date: '',
    total: '',
});

const formattedTotal = computed({
    get() {
        if (!form.total) return '';
        const value = parseFloat(form.total);
        return isNaN(value) ? '' : value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
    },
    set(value) {
        const numericValue = value.replace(/[^\d,]/g, '').replace(',', '.');
        form.total = numericValue;
    }
});

const submit = () => {
    form.post(route('contracts.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Novo Contrato" />

    <AppLayout>
        <div class="py-6">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Contract Code -->
                            <div>
                                <InputLabel for="code" value="Código do Contrato *" />
                                <Input
                                    id="code"
                                    v-model="form.code"
                                    type="text"
                                    class="mt-1 block w-full font-mono"
                                    required
                                    autofocus
                                    :placeholder="nextCode"
                                />
                                <p class="mt-1 text-sm text-gray-500">
                                    Sugestão: {{ nextCode }}
                                </p>
                                <InputError :message="form.errors.code" class="mt-2" />
                            </div>

                            <!-- Title -->
                            <div>
                                <InputLabel for="title" value="Título *" />
                                <Input
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Digite o título do contrato"
                                />
                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <InputLabel for="description" value="Descrição" />
                                <textarea
                                    id="description"
                                    v-model="form.description"
                                    rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Digite uma descrição detalhada do contrato"
                                ></textarea>
                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>

                            <!-- Two Column Layout for Supplier and Contract Type -->
                            <div class="grid gap-6 md:grid-cols-2">
                                <!-- Supplier -->
                                <div>
                                    <InputLabel for="supplier_id" value="Fornecedor *" />
                                    <select
                                        id="supplier_id"
                                        v-model="form.supplier_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    >
                                        <option value="">Selecione um fornecedor</option>
                                        <option
                                            v-for="supplier in suppliers"
                                            :key="supplier.id"
                                            :value="supplier.id"
                                        >
                                            {{ supplier.trade_name }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.supplier_id" class="mt-2" />
                                </div>

                                <!-- Contract Type -->
                                <div>
                                    <InputLabel for="contract_type_id" value="Tipo de Contrato *" />
                                    <select
                                        id="contract_type_id"
                                        v-model="form.contract_type_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    >
                                        <option value="">Selecione um tipo</option>
                                        <option
                                            v-for="type in contractTypes"
                                            :key="type.id"
                                            :value="type.id"
                                        >
                                            {{ type.name }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.contract_type_id" class="mt-2" />
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <InputLabel for="status" value="Status *" />
                                <select
                                    id="status"
                                    v-model="form.status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option
                                        v-for="status in statusOptions"
                                        :key="status"
                                        :value="status"
                                    >
                                        {{ status }}
                                    </option>
                                </select>
                                <InputError :message="form.errors.status" class="mt-2" />
                            </div>

                            <!-- Two Column Layout for Dates -->
                            <div class="grid gap-6 md:grid-cols-2">
                                <!-- Start Date -->
                                <div>
                                    <InputLabel for="start_date" value="Data de Início *" />
                                    <Input
                                        id="start_date"
                                        v-model="form.start_date"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError :message="form.errors.start_date" class="mt-2" />
                                </div>

                                <!-- End Date -->
                                <div>
                                    <InputLabel for="end_date" value="Data de Término *" />
                                    <Input
                                        id="end_date"
                                        v-model="form.end_date"
                                        type="date"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError :message="form.errors.end_date" class="mt-2" />
                                </div>
                            </div>

                            <!-- Total Value -->
                            <div>
                                <InputLabel for="total" value="Valor Total (R$) *" />
                                <div class="relative mt-1">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                        R$
                                    </span>
                                    <Input
                                        id="total"
                                        v-model="form.total"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="block w-full pl-12"
                                        required
                                        placeholder="0,00"
                                    />
                                </div>
                                <InputError :message="form.errors.total" class="mt-2" />
                            </div>

                            <!-- Form Actions -->
                            <div class="flex items-center justify-end gap-4 border-t border-gray-200 pt-6">
                                <SecondaryButton
                                    type="button"
                                    @click="$inertia.visit(route('dashboard'))"
                                >
                                    Cancelar
                                </SecondaryButton>
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing">Criando...</span>
                                    <span v-else>Criar Contrato</span>
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
