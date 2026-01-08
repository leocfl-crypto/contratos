<script setup>
import Checkbox from '@/components/Checkbox.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import InputError from '@/components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail, Lock, ArrowRight, User as UserIcon, Info } from 'lucide-vue-next';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="bg-white p-8 sm:p-12 rounded-3xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] border border-slate-100">
            <!-- Header Section -->
            <div class="mb-10 text-left">
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">
                    Acesse sua conta
                </h1>
                <p class="text-slate-500 font-medium">
                    Digite suas credenciais para continuar
                </p>
            </div>

            <!-- Status Message -->
            <div 
                v-if="status" 
                class="mb-8 px-4 py-3 rounded-2xl bg-blue-50 border border-blue-100 text-sm text-blue-700 font-medium"
            >
                {{ status }}
            </div>

            <!-- Login Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <!-- User/Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-bold text-slate-700 ml-1">
                        E-mail do Usuário
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-blue-600">
                            <UserIcon :size="20" class="text-slate-400" />
                        </div>
                        <input
                            id="email"
                            type="email"
                            class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 rounded-xl py-4 pl-12 pr-4 focus:bg-white focus:border-slate-900 focus:ring-0 focus:outline-none transition-all duration-300 shadow-sm"
                            v-model="form.email"
                            required
                            autofocus
                            placeholder="ex: nome.sobrenome"
                        />
                    </div>
                    <InputError class="mt-2 text-xs text-rose-600 font-medium" :message="form.errors.email" />
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-bold text-slate-700 ml-1">
                        Senha
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-blue-600">
                            <Lock :size="20" class="text-slate-400" />
                        </div>
                        <input
                            id="password"
                            type="password"
                            class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 rounded-xl py-4 pl-12 pr-4 focus:bg-white focus:border-slate-900 focus:ring-0 focus:outline-none transition-all duration-300 shadow-sm"
                            v-model="form.password"
                            required
                            placeholder="••••••••"
                        />
                    </div>
                    <InputError class="mt-2 text-xs text-rose-600 font-medium" :message="form.errors.password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between ml-1 pt-2">
                    <label class="flex items-center cursor-pointer group">
                        <input 
                            type="checkbox" 
                            v-model="form.remember"
                            class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900 transition-all duration-300 cursor-pointer"
                        />
                        <span class="ml-3 text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">
                            Manter-me conectado
                        </span>
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors"
                    >
                        Esqueceu a senha?
                    </Link>
                </div>

                <!-- Login Button -->
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full py-4 px-6 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-lg shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 disabled:opacity-70"
                        :disabled="form.processing"
                    >
                        <div class="flex items-center justify-center gap-3">
                            <span v-if="form.processing" class="h-5 w-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            <span v-else>Entrar</span>
                        </div>
                    </button>
                </div>
            </form>

            <!-- LDAP Notice Box -->
            <div class="mt-10 p-5 rounded-2xl bg-blue-50 border border-blue-100 flex gap-4 items-start">
                <div class="mt-1 p-2 bg-blue-500 rounded-full shrink-0">
                    <Info :size="16" class="text-white" />
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-blue-900 uppercase tracking-tight mb-1">Autenticação via LDAP</h4>
                    <p class="text-xs text-blue-800 leading-relaxed">
                        Use o mesmo <span class="font-bold">usuário e senha</span> que você utiliza para fazer login no seu computador.
                    </p>
                </div>
            </div>

            <!-- Footer developed by -->
            <div class="mt-12 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    Desenvolvido por <span class="text-slate-600">Prefeitura Municipal de Lagoa Santa</span>
                </p>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Spinner for loading state */
.spinner {
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Staggered animations */
.animate-slide-up {
    animation: slideUp 0.5s ease-out backwards;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out backwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
