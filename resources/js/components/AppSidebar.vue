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
                                    <span class="truncate font-bold text-lg leading-tight bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                        DocManager
                                    </span>
                                    <span class="text-xs text-muted-foreground tracking-wide">
                                        Gestão de Documentos
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

        <!-- User menu movido para o header -->
    </Sidebar>
    <slot />
</template>

<style scoped>
.sidebar-modern {
    background: hsl(0 0% 100%);
    border-right: 1px solid hsl(220 13% 91%);
}

.sidebar-header {
    padding: 1.25rem 1rem;
    border-bottom: none;
}

.sidebar-brand {
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    background: transparent;
}

.sidebar-brand:hover {
    background: hsl(220 14% 96%);
}

.sidebar-content {
    padding: 0.75rem 0.5rem;
    flex: 1;
    overflow-y: auto;
}

.sidebar-content::-webkit-scrollbar {
    width: 4px;
}

.sidebar-content::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-content::-webkit-scrollbar-thumb {
    background: hsl(220 13% 85%);
    border-radius: 2px;
}

.sidebar-content::-webkit-scrollbar-thumb:hover {
    background: hsl(220 13% 75%);
}

.sidebar-footer {
    padding: 1rem;
    border-top: 1px solid hsl(220 13% 91%);
}
</style>
