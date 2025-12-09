<script setup lang="ts">
import { computed } from 'vue';
import { Bar } from 'vue-chartjs';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
    type ChartData,
    type ChartOptions
} from 'chart.js';

ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend
);

interface Props {
    labels: string[];
    data: number[];
}

const props = defineProps<Props>();

const chartData = computed<ChartData<'bar'>>(() => ({
    labels: props.labels,
    datasets: [
        {
            label: 'Quantidade',
            data: props.data,
            backgroundColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                gradient.addColorStop(0, 'rgba(168, 85, 247, 0.8)');
                gradient.addColorStop(1, 'rgba(59, 130, 246, 0.8)');
                return gradient;
            },
            borderColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                gradient.addColorStop(0, 'rgb(168, 85, 247)');
                gradient.addColorStop(1, 'rgb(59, 130, 246)');
                return gradient;
            },
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false
        }
    ]
}));

const chartOptions: ChartOptions<'bar'> = {
    indexAxis: 'y',
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
        x: {
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
                color: 'rgba(226, 232, 240, 0.5)',
                drawBorder: false
            },
            border: {
                display: false
            }
        },
        y: {
            ticks: {
                font: {
                    size: 11,
                    family: 'Inter, sans-serif',
                    weight: 500
                },
                color: '#334155'
            },
            grid: {
                display: false,
                drawBorder: false
            },
            border: {
                display: false
            }
        }
    },
    animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
    }
};
</script>

<template>
    <div class="relative h-full w-full">
        <Bar :data="chartData" :options="chartOptions" />
    </div>
</template>
