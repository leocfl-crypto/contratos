import { onMounted, ref } from 'vue';

export interface DashboardSection {
    id: string;
    label: string;
    visible: boolean;
    order: number;
}

const defaultSections: DashboardSection[] = [
    { id: 'stats', label: 'Estatísticas', visible: true, order: 0 },
    { id: 'quickActions', label: 'Ações Rápidas', visible: true, order: 1 },
    { id: 'recentContracts', label: 'Contratos Recentes', visible: true, order: 2 },
    { id: 'charts', label: 'Gráficos', visible: true, order: 3 },
];

const getStoredSections = (): DashboardSection[] | null => {
    if (typeof window === 'undefined') {
        return null;
    }

    const stored = localStorage.getItem('dashboardSections');
    if (stored) {
        try {
            return JSON.parse(stored);
        } catch {
            return null;
        }
    }
    return null;
};

const sections = ref<DashboardSection[]>([...defaultSections]);

export function useDashboardLayout() {
    onMounted(() => {
        const storedSections = getStoredSections();
        if (storedSections) {
            sections.value = storedSections;
        }
    });

    function saveSections() {
        localStorage.setItem('dashboardSections', JSON.stringify(sections.value));
    }

    function toggleSection(id: string) {
        const section = sections.value.find(s => s.id === id);
        if (section) {
            section.visible = !section.visible;
            saveSections();
        }
    }

    function moveUp(id: string) {
        const index = sections.value.findIndex(s => s.id === id);
        if (index > 0) {
            const temp = sections.value[index];
            sections.value[index] = sections.value[index - 1];
            sections.value[index - 1] = temp;
            // Update order values
            sections.value.forEach((s, i) => s.order = i);
            saveSections();
        }
    }

    function moveDown(id: string) {
        const index = sections.value.findIndex(s => s.id === id);
        if (index < sections.value.length - 1) {
            const temp = sections.value[index];
            sections.value[index] = sections.value[index + 1];
            sections.value[index + 1] = temp;
            // Update order values
            sections.value.forEach((s, i) => s.order = i);
            saveSections();
        }
    }

    function resetToDefault() {
        sections.value = [...defaultSections];
        saveSections();
    }

    function isSectionVisible(id: string): boolean {
        const section = sections.value.find(s => s.id === id);
        return section?.visible ?? true;
    }

    function getSortedSections(): DashboardSection[] {
        return [...sections.value].sort((a, b) => a.order - b.order);
    }

    return {
        sections,
        toggleSection,
        moveUp,
        moveDown,
        resetToDefault,
        isSectionVisible,
        getSortedSections,
    };
}

export function initializeDashboardLayout() {
    if (typeof window === 'undefined') {
        return;
    }

    const storedSections = getStoredSections();
    if (storedSections) {
        sections.value = storedSections;
    }
}
