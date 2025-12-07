<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail, Lock, ArrowRight } from 'lucide-vue-next';

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

        <!-- Welcome Header -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Bem-vindo de volta! 👋
            </h1>
            <p class="text-gray-600 text-sm">
                Entre com suas credenciais para continuar
            </p>
        </div>

        <!-- Status Message -->
        <div 
            v-if="status" 
            class="mb-6 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-sm text-green-700 animate-slide-down"
        >
            {{ status }}
        </div>

        <!-- Login Form -->
        <form @submit.prevent="submit" class="space-y-5">
            <!-- Email Field -->
            <div class="space-y-2 animate-slide-up" style="animation-delay: 0.1s;">
                <label for="email" class="block text-sm font-semibold text-gray-700">
                    Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <Mail :size="20" class="text-gray-400" />
                    </div>
                    <input
                        id="email"
                        type="email"
                        class="input-modern w-full pl-12 pr-4"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="seu@email.com"
                    />
                </div>
                <InputError class="mt-2 text-sm animate-slide-down" :message="form.errors.email" />
            </div>

            <!-- Password Field -->
            <div class="space-y-2 animate-slide-up" style="animation-delay: 0.2s;">
                <label for="password" class="block text-sm font-semibold text-gray-700">
                    Senha
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <Lock :size="20" class="text-gray-400" />
                    </div>
                    <input
                        id="password"
                        type="password"
                        class="input-modern w-full pl-12 pr-4"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                </div>
                <InputError class="mt-2 text-sm animate-slide-down" :message="form.errors.password" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between animate-slide-up" style="animation-delay: 0.3s;">
                <label class="flex items-center cursor-pointer group">
                    <Checkbox 
                        name="remember" 
                        v-model:checked="form.remember"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 transition-all"
                    />
                    <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-800 transition-colors">
                        Lembrar-me
                    </span>
                </label>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors"
                >
                    Esqueceu a senha?
                </Link>
            </div>

            <!-- Login Button -->
            <div class="pt-2 animate-slide-up" style="animation-delay: 0.4s;">
                <button
                    type="submit"
                    class="btn-login w-full flex items-center justify-center gap-2"
                    :class="{ 'opacity-60': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing" class="spinner"></span>
                    <span v-else>Entrar</span>
                    <ArrowRight v-if="!form.processing" :size="20" class="transition-transform group-hover:translate-x-1" />
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative my-8 animate-fade-in" style="animation-delay: 0.5s;">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">ou</span>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center animate-fade-in" style="animation-delay: 0.6s;">
            <p class="text-sm text-gray-600">
                Não tem uma conta?
                <Link
                    :href="route('register')"
                    class="font-semibold text-blue-600 hover:text-blue-700 transition-colors"
                >
                    Criar conta
                </Link>
            </p>
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
