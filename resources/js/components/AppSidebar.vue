<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { 
    LayoutDashboard, 
    FileText, 
    FilePlus, 
    Settings,
    User,
    Lock,
    Palette,
    FileEdit,
    Shield
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutDashboard,
    },
    {
        title: 'Contratos',
        icon: FileText,
        items: [
            {
                title: 'Listar Contratos',
                href: '/contratos',
                icon: FileText,
            },
            {
                title: 'Novo Contrato',
                href: '/contratos/novo',
                icon: FilePlus,
            },
        ],
    },
    {
        title: 'Configurações',
        icon: Settings,
        items: [
            {
                title: 'Perfil',
                href: '/settings/profile',
                icon: User,
            },
            {
                title: 'Senha',
                href: '/settings/password',
                icon: Lock,
            },
            {
                title: 'Aparência',
                href: '/settings/appearance',
                icon: Palette,
            },
            {
                title: 'Autenticação 2FA',
                href: '/settings/two-factor',
                icon: Shield,
            },
        ],
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" class="sidebar-modern">
        <SidebarHeader class="sidebar-header">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child class="sidebar-brand">
                        <Link :href="dashboard()">
                            <div class="flex items-center gap-3 w-full">
                                <AppLogo class="h-8 w-8" />
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="truncate font-bold text-lg leading-tight">
                                        Laravel
                                    </span>
                                </div>
                            </div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="sidebar-content">
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter class="sidebar-footer">
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>

<style scoped>
.sidebar-modern {
    background: linear-gradient(
        180deg,
        hsl(var(--sidebar-background)) 0%,
        hsl(var(--sidebar-background) / 0.98) 50%,
        hsl(var(--sidebar-background) / 0.95) 100%
    );
    backdrop-filter: blur(20px);
    border-right: 1px solid hsl(var(--border) / 0.5);
}

.sidebar-header {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid hsl(var(--border) / 0.3);
    background: linear-gradient(
        135deg,
        hsl(var(--primary) / 0.03) 0%,
        transparent 100%
    );
}

.sidebar-brand {
    padding: 0.75rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
}

.sidebar-brand:hover {
    background: linear-gradient(
        135deg,
        hsl(var(--primary) / 0.08) 0%,
        hsl(var(--primary) / 0.04) 100%
    );
    transform: translateY(-1px);
}

.logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.625rem;
    background: linear-gradient(
        135deg,
        hsl(var(--primary)) 0%,
        hsl(var(--primary) / 0.8) 100%
    );
    box-shadow: 
        0 4px 12px hsl(var(--primary) / 0.25),
        0 0 0 1px hsl(var(--primary) / 0.1) inset;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar-brand:hover .logo-container {
    box-shadow: 
        0 6px 20px hsl(var(--primary) / 0.35),
        0 0 0 1px hsl(var(--primary) / 0.2) inset;
    transform: scale(1.05);
}

.brand-title {
    font-size: 0.9375rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    background: linear-gradient(
        135deg,
        hsl(var(--foreground)) 0%,
        hsl(var(--foreground) / 0.8) 100%
    );
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.3;
}

.brand-subtitle {
    font-size: 0.6875rem;
    font-weight: 500;
    color: hsl(var(--muted-foreground));
    letter-spacing: 0.02em;
    line-height: 1.2;
    margin-top: 0.125rem;
}

.sidebar-content {
    padding: 1rem 0.75rem;
    flex: 1;
    overflow-y: auto;
}

.sidebar-content::-webkit-scrollbar {
    width: 6px;
}

.sidebar-content::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-content::-webkit-scrollbar-thumb {
    background: hsl(var(--border) / 0.3);
    border-radius: 3px;
}

.sidebar-content::-webkit-scrollbar-thumb:hover {
    background: hsl(var(--border) / 0.5);
}

.sidebar-footer {
    padding: 1rem;
    border-top: 1px solid hsl(var(--border) / 0.3);
    background: linear-gradient(
        0deg,
        hsl(var(--sidebar-background) / 0.5) 0%,
        transparent 100%
    );
}
</style>
