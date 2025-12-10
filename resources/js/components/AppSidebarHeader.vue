<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { ChevronDown } from 'lucide-vue-next';
import { computed } from 'vue';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);

const page = usePage();
const auth = computed(() => page.props.auth);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2 flex-1 min-w-0">
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        
        <!-- User Menu no lado direito -->
        <div class="flex items-center gap-3">
            <DropdownMenu>
                <DropdownMenuTrigger :as-child="true">
                    <Button
                        variant="ghost"
                        class="relative h-auto w-auto rounded-full py-1.5 px-2 focus-within:ring-2 focus-within:ring-primary hover:bg-accent flex items-center gap-2"
                    >
                        <Avatar
                            class="size-8 overflow-hidden rounded-full"
                        >
                            <AvatarImage
                                v-if="auth.user.avatar"
                                :src="auth.user.avatar"
                                :alt="auth.user.name"
                            />
                            <AvatarFallback
                                class="rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 font-semibold text-white"
                            >
                                {{ getInitials(auth.user?.name) }}
                            </AvatarFallback>
                        </Avatar>
                        <span class="text-sm font-medium text-foreground">
                            {{ auth.user?.name }}
                        </span>
                        <ChevronDown class="size-4 text-muted-foreground" />
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end" class="w-56">
                    <UserMenuContent :user="auth.user" />
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
    </header>
</template>
