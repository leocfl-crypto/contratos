<script setup lang="ts">
</script>

<template>
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-current">
        <defs>
            <linearGradient id="docGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#3B82F6" />
                <stop offset="100%" style="stop-color:#6366F1" />
            </linearGradient>
        </defs>
        <!-- Documento principal -->
        <path fill="url(#docGradient)" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
        <!-- Dobra do canto -->
        <path fill="#1E40AF" opacity="0.3" d="M14 2v6h6l-6-6z"/>
        <!-- Linhas de texto -->
        <path fill="#ffffff" opacity="0.9" d="M8 13h8v1.5H8zM8 16h5v1.5H8z"/>
        <!-- Checkmark/assinatura -->
        <circle cx="16" cy="17" r="3" fill="#22C55E"/>
        <path d="M15 17l0.8 0.8 1.7-1.7" stroke="#ffffff" stroke-width="0.8" fill="none"/>
    </svg>
</template>
