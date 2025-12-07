<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="login-gradient-bg min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-hidden">
        <!-- Decorative floating shapes -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl floating-shape"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl floating-shape-reverse"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-300/10 rounded-full blur-3xl floating-shape" style="animation-delay: -3s;"></div>

        <div class="relative z-10 w-full max-w-md animate-scale-in">
            <!-- Logo Container -->
            <div class="text-center mb-8 animate-fade-in">
                <Link href="/" class="inline-block">
                    <ApplicationLogo class="h-16 w-16 mx-auto fill-current text-white drop-shadow-lg hover-scale" />
                </Link>
            </div>

            <!-- Login Card -->
            <div class="login-card p-8 sm:p-10 animate-slide-up">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Additional scoped animations */
@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes float-reverse {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(20px) rotate(-5deg);
    }
}
</style>
