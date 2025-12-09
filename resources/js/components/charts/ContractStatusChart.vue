<script setup lang="ts">
import { computed } from 'vue';
import { Doughnut } from 'vue-chartjs';
import {
    Chart as ChartJS,
    ArcElement,
    Tooltip,
    Legend,
    type ChartData,
    type ChartOptions
} from 'chart.js';

ChartJS.register(ArcElement, Tooltip, Legend);

interface Props {
    data: {
        active: number;
        pending: number;
        completed: number;
        expired: number;
    };
}

const props = defineProps<Props>();

const chartData = computed<ChartData<'doughnut'>>(() => ({
    labels: ['Ativos', 'Pendentes', 'Concluídos', 'Vencidos'],
    datasets: [
        {
            data: [
                props.data.active,
                props.data.pending,
                props.data.completed,
                props.data.expired
            ],
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',  // Blue - Ativos
                'rgba(251, 191, 36, 0.8)',  // Yellow - Pendentes
                'rgba(16, 185, 129, 0.8)',  // Green - Concluídos
                'rgba(239, 68, 68, 0.8)'    // Red - Vencidos
            ],
            borderColor: [
                'rgb(59, 130, 246)',
                'rgb(251, 191, 36)',
                'rgb(16, 185, 129)',
                'rgb(239, 68, 68)'
            ],
            borderWidth: 2,
            hoverOffset: 10
        }
    ]
}));

const chartOptions: ChartOptions<'doughnut'> = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                padding: 15,
                font: {
                    size: 12,
                    family: 'Inter, sans-serif',
                    weight: 500
                },
                usePointStyle: true,
                pointStyle: 'circle'
            }
        },
        tooltip: {
            backgroundColor: 'rgba(15, 23, 42, 0.9)',
            padding: 12,
            titleFont: {
                size: 14,
                family: 'Inter, sans-serif',
                weight: 600
            },
            bodyFont: {
                size: 13,
                family: 'Inter, sans-serif'
            },
            borderColor: 'rgba(255, 255, 255, 0.1)',
            borderWidth: 1,
            cornerRadius: 8
        }
    },
    cutout: '65%',
    animation: {
        animateRotate: true,
        animateScale: true,
        duration: 1000,
        easing: 'easeInOutQuart'
    }
};
</script>

<template>
    <div class="relative h-full w-full">
        <Doughnut :data="chartData" :options="chartOptions" />
    </div>
</template>
