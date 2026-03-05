<script setup lang="ts">
import { useLayoutProps } from '@inertiajs/vue3';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const layout = useLayoutProps({
    subtitle: '',
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            v-if="layout.subtitle"
            class="border-b border-sidebar-border/70 bg-primary/5 px-6 py-2 text-sm text-primary md:px-4"
        >
            {{ layout.subtitle }}
        </div>
        <slot />
    </AppLayout>
</template>
