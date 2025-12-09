<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from '@/components/ui/sidebar';
import { usePage } from '@inertiajs/vue3';
import { ChevronsUpDown } from 'lucide-vue-next';
import UserMenuContent from './UserMenuContent.vue';

const page = usePage();
const user = page.props.auth.user;
const { isMobile, state } = useSidebar();
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem>
            <DropdownMenu>
                <DropdownMenuTrigger as-child>
                    <SidebarMenuButton
                        size="lg"
                        class="user-menu-button"
                        data-test="sidebar-menu-button"
                    >
                        <UserInfo :user="user" />
                        <ChevronsUpDown class="ml-auto size-4 transition-transform duration-300 group-data-[state=open]:rotate-180" />
                    </SidebarMenuButton>
                </DropdownMenuTrigger>
                <DropdownMenuContent
                    class="w-(--reka-dropdown-menu-trigger-width) min-w-56 rounded-lg"
                    :side="
                        isMobile
                            ? 'bottom'
                            : state === 'collapsed'
                              ? 'left'
                              : 'bottom'
                    "
                    align="end"
                    :side-offset="4"
                >
                    <UserMenuContent :user="user" />
                </DropdownMenuContent>
            </DropdownMenu>
        </SidebarMenuItem>
    </SidebarMenu>
</template>

<style scoped>
.user-menu-button {
    padding: 0.75rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
    position: relative;
    overflow: hidden;
}

.user-menu-button::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        hsl(var(--primary) / 0.05) 0%,
        transparent 100%
    );
    opacity: 0;
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 0.75rem;
}

.user-menu-button:hover::before {
    opacity: 1;
}

.user-menu-button:hover {
    background: linear-gradient(
        135deg,
        hsl(var(--sidebar-accent)) 0%,
        hsl(var(--sidebar-accent) / 0.5) 100%
    );
    transform: translateY(-1px);
    box-shadow: 0 2px 8px hsl(var(--primary) / 0.1);
}

.user-menu-button[data-state="open"] {
    background: linear-gradient(
        135deg,
        hsl(var(--sidebar-accent)) 0%,
        hsl(var(--sidebar-accent) / 0.7) 100%
    );
    box-shadow: 0 4px 12px hsl(var(--primary) / 0.15);
}
</style>
