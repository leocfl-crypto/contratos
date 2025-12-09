<script setup lang="ts">
import { computed } from 'vue';
import { Line } from 'vue-chartjs';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler,
    type ChartData,
    type ChartOptions
} from 'chart.js';

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler
);

interface Props {
    labels: string[];
    data: number[];
}

const props = defineProps<Props>();

const chartData = computed<ChartData<'line'>>(() => ({
    labels: props.labels,
    datasets: [
        {
            label: 'Contratos Criados',
            data: props.data,
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
                gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');
                return gradient;
            },
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'rgb(59, 130, 246)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverBackgroundColor: 'rgb(37, 99, 235)',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 3
        }
    ]
}));

const chartOptions: ChartOptions<'line'> = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false
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
            cornerRadius: 8,
            displayColors: false
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                font: {
                    size: 11,
                    family: 'Inter, sans-serif'
                },
                color: '#64748b',
                precision: 0
            },
            grid: {
                color: 'rgba(226, 232, 240, 0.5)'
            },
            border: {
                display: false
            }
        },
        x: {
            ticks: {
                font: {
                    size: 11,
                    family: 'Inter, sans-serif'
                },
                color: '#64748b'
            },
            grid: {
                display: false
            },
            border: {
                display: false
            }
        }
    },
    interaction: {
        intersect: false,
        mode: 'index'
    },
    animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
    }
};
</script>

<template>
    <div class="relative h-full w-full">
        <Line :data="chartData" :options="chartOptions" />
    </div>
</template>
