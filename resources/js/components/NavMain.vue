<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    items: NavItem[];
}>();

const page = usePage();
const expandedItems = ref<Set<string>>(new Set(['Contratos']));

const toggleItem = (title: string) => {
    if (expandedItems.value.has(title)) {
        expandedItems.value.delete(title);
    } else {
        expandedItems.value.add(title);
    }
};

const isExpanded = (title: string) => expandedItems.value.has(title);
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel class="text-xs font-bold text-sidebar-foreground/60 uppercase tracking-widest mb-3 px-2">
            Menu Principal
        </SidebarGroupLabel>
        <SidebarMenu class="space-y-1">
            <template v-for="item in items" :key="item.title">
                <!-- Item com submenu -->
                <SidebarMenuItem v-if="item.items && item.items.length > 0">
                    <SidebarMenuButton
                        @click="toggleItem(item.title)"
                        :tooltip="item.title"
                        class="group/menu-item relative overflow-hidden transition-all duration-300 hover:bg-gradient-to-r hover:from-sidebar-accent hover:to-sidebar-accent/50 rounded-xl"
                    >
                        <div class="flex items-center gap-3 relative z-10">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-primary-500/10 to-primary-600/10 group-hover/menu-item:from-primary-500/20 group-hover/menu-item:to-primary-600/20 transition-all duration-300">
                                <component :is="item.icon" class="h-5 w-5 text-primary-600 transition-all duration-300 group-hover/menu-item:scale-110 group-hover/menu-item:rotate-3" />
                            </div>
                            <span class="font-semibold text-sidebar-foreground">{{ item.title }}</span>
                        </div>
                        <ChevronRight 
                            class="ml-auto transition-all duration-500 ease-out relative z-10"
                            :class="isExpanded(item.title) ? 'rotate-90 text-primary-600' : 'text-sidebar-foreground/50'"
                        />
                        <!-- Glassmorphism effect on hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-500/0 to-primary-600/0 group-hover/menu-item:from-primary-500/5 group-hover/menu-item:to-primary-600/5 transition-all duration-300 rounded-xl"></div>
                    </SidebarMenuButton>
                    <Transition
                        enter-active-class="transition-all duration-300 ease-out"
                        enter-from-class="opacity-0 max-h-0 -translate-y-2"
                        enter-to-class="opacity-100 max-h-96 translate-y-0"
                        leave-active-class="transition-all duration-200 ease-in"
                        leave-from-class="opacity-100 max-h-96 translate-y-0"
                        leave-to-class="opacity-0 max-h-0 -translate-y-2"
                    >
                        <SidebarMenuSub v-show="isExpanded(item.title)" class="overflow-hidden ml-2 mt-1 space-y-1">
                            <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                                <SidebarMenuSubButton
                                    as-child
                                    :is-active="urlIsActive(subItem.href!, page.url)"
                                    class="group/sub-item relative overflow-hidden transition-all duration-300 hover:bg-gradient-to-r hover:from-sidebar-accent/60 hover:to-sidebar-accent/30 hover:translate-x-2 rounded-lg data-[active=true]:bg-gradient-to-r data-[active=true]:from-primary-500/20 data-[active=true]:to-primary-600/10"
                                >
                                    <Link :href="subItem.href!">
                                        <div class="flex items-center gap-3 relative z-10">
                                            <div class="flex h-7 w-7 items-center justify-center rounded-md bg-sidebar-accent/50 group-hover/sub-item:bg-primary-500/10 transition-all duration-300">
                                                <component :is="subItem.icon" class="h-4 w-4 transition-all duration-300 group-hover/sub-item:scale-110" />
                                            </div>
                                            <span class="text-sm">{{ subItem.title }}</span>
                                        </div>
                                        <!-- Active indicator -->
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-0 bg-gradient-to-b from-primary-500 to-primary-600 rounded-r-full transition-all duration-300 group-data-[active=true]/sub-item:h-8"></div>
                                    </Link>
                                </SidebarMenuSubButton>
                            </SidebarMenuSubItem>
                        </SidebarMenuSub>
                    </Transition>
                </SidebarMenuItem>

                <!-- Item simples sem submenu -->
                <SidebarMenuItem v-else>
                    <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(item.href!, page.url)"
                        :tooltip="item.title"
                        class="group/menu-item relative overflow-hidden transition-all duration-300 hover:bg-gradient-to-r hover:from-sidebar-accent hover:to-sidebar-accent/50 hover:translate-x-1 rounded-xl data-[active=true]:bg-gradient-to-r data-[active=true]:from-primary-500/20 data-[active=true]:to-primary-600/10"
                    >
                        <Link :href="item.href!">
                            <div class="flex items-center gap-3 relative z-10">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-primary-500/10 to-primary-600/10 group-hover/menu-item:from-primary-500/20 group-hover/menu-item:to-primary-600/20 group-data-[active=true]/menu-item:from-primary-500/30 group-data-[active=true]/menu-item:to-primary-600/30 transition-all duration-300">
                                    <component :is="item.icon" class="h-5 w-5 text-primary-600 transition-all duration-300 group-hover/menu-item:scale-110 group-hover/menu-item:rotate-3" />
                                </div>
                                <span class="font-semibold text-sidebar-foreground">{{ item.title }}</span>
                            </div>
                            <!-- Active indicator -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-0 bg-gradient-to-b from-primary-500 to-primary-600 rounded-r-full transition-all duration-300 group-data-[active=true]/menu-item:h-10"></div>
                            <!-- Glassmorphism effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-500/0 to-primary-600/0 group-hover/menu-item:from-primary-500/5 group-hover/menu-item:to-primary-600/5 transition-all duration-300 rounded-xl"></div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </template>
        </SidebarMenu>
    </SidebarGroup>
</template>
