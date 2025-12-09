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
    <SidebarGroup class="px-3 py-2">
        <SidebarMenu class="space-y-1">
            <template v-for="item in items" :key="item.title">
                <!-- Item com submenu -->
                <SidebarMenuItem v-if="item.items && item.items.length > 0">
                    <SidebarMenuButton
                        @click="toggleItem(item.title)"
                        :tooltip="item.title"
                        class="nav-item"
                    >
                        <component :is="item.icon" class="nav-icon" />
                        <span class="nav-text">{{ item.title }}</span>
                        <ChevronRight 
                            class="nav-chevron"
                            :class="isExpanded(item.title) ? 'rotate-90' : ''"
                        />
                    </SidebarMenuButton>
                    <Transition
                        enter-active-class="transition-all duration-200 ease-out"
                        enter-from-class="opacity-0 -translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition-all duration-150 ease-in"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 -translate-y-1"
                    >
                        <SidebarMenuSub v-show="isExpanded(item.title)" class="nav-submenu">
                            <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                                <SidebarMenuSubButton
                                    as-child
                                    :is-active="urlIsActive(subItem.href!, page.url)"
                                    class="nav-subitem"
                                >
                                    <Link :href="subItem.href!">
                                        <component :is="subItem.icon" class="nav-subicon" />
                                        <span>{{ subItem.title }}</span>
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
                        class="nav-item"
                    >
                        <Link :href="item.href!">
                            <component :is="item.icon" class="nav-icon" />
                            <span class="nav-text">{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </template>
        </SidebarMenu>
    </SidebarGroup>
</template>

<style scoped>
.nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.625rem 0.75rem;
    border-radius: 0.5rem;
    color: hsl(220 9% 46%);
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.15s ease;
    cursor: pointer;
}

.nav-item:hover {
    background: hsl(220 14% 96%);
    color: hsl(220 9% 20%);
}

.nav-item[data-active="true"] {
    background: linear-gradient(135deg, hsl(262 83% 58% / 0.1) 0%, hsl(262 83% 58% / 0.05) 100%);
    color: hsl(262 83% 58%);
}

.nav-icon {
    width: 1.125rem;
    height: 1.125rem;
    flex-shrink: 0;
}

.nav-text {
    flex: 1;
}

.nav-chevron {
    width: 1rem;
    height: 1rem;
    opacity: 0.5;
    transition: transform 0.2s ease;
}

.nav-submenu {
    margin-left: 1.5rem;
    margin-top: 0.25rem;
    padding-left: 0.75rem;
    border-left: 1px solid hsl(220 13% 91%);
}

.nav-subitem {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.5rem 0.625rem;
    border-radius: 0.375rem;
    color: hsl(220 9% 46%);
    font-size: 0.8125rem;
    font-weight: 400;
    transition: all 0.15s ease;
}

.nav-subitem:hover {
    background: hsl(220 14% 96%);
    color: hsl(220 9% 20%);
}

.nav-subitem[data-active="true"] {
    background: hsl(262 83% 58% / 0.08);
    color: hsl(262 83% 58%);
    font-weight: 500;
}

.nav-subicon {
    width: 1rem;
    height: 1rem;
    flex-shrink: 0;
    opacity: 0.7;
}
</style>
