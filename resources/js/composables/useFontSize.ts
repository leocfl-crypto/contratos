import { onMounted, ref } from 'vue';

type FontSize = 'small' | 'medium' | 'large';

const fontSizeMap: Record<FontSize, string> = {
    small: '14px',
    medium: '16px',
    large: '18px',
};

export function updateFontSize(value: FontSize) {
    if (typeof window === 'undefined') {
        return;
    }

    document.documentElement.style.fontSize = fontSizeMap[value];
}

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const getStoredFontSize = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    return localStorage.getItem('fontSize') as FontSize | null;
};

export function initializeFontSize() {
    if (typeof window === 'undefined') {
        return;
    }

    const savedFontSize = getStoredFontSize();
    updateFontSize(savedFontSize || 'medium');
}

const fontSize = ref<FontSize>('medium');

export function useFontSize() {
    onMounted(() => {
        const savedFontSize = localStorage.getItem('fontSize') as FontSize | null;

        if (savedFontSize) {
            fontSize.value = savedFontSize;
        }
    });

    function changeFontSize(value: FontSize) {
        fontSize.value = value;

        localStorage.setItem('fontSize', value);
        setCookie('fontSize', value);
        updateFontSize(value);
    }

    return {
        fontSize,
        changeFontSize,
    };
}
