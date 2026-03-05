<script setup lang="ts">
import { Head, resetLayoutProps, setLayoutProps } from '@inertiajs/vue3';
import { ref } from 'vue';
import FeatureCard from '@/components/FeatureCard.vue';
import FeatureHeader from '@/components/FeatureHeader.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Layouts & Head' },
    { title: 'Layout Props' },
];

const subtitle = ref('');

function apply() {
    if (subtitle.value) {
        setLayoutProps({ subtitle: subtitle.value });
    }
}

function reset() {
    subtitle.value = '';
    resetLayoutProps();
}
</script>

<template>
    <Head title="Layout Props" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-4">
            <FeatureHeader
                title="Layout Props"
                docs="the-basics/layouts#layout-props"
                controller="app/Http/Controllers/Feature/LayoutController.php#L25"
            >
                Pass data from pages to layouts with
                <code class="text-xs">setLayoutProps()</code> and
                <code class="text-xs">useLayoutProps()</code>.
            </FeatureHeader>

            <div class="grid gap-6 lg:grid-cols-2">
                <FeatureCard
                    title="setLayoutProps()"
                    description="Type a subtitle and click Apply. A banner appears below the breadcrumbs."
                >
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <Label for="subtitle">Subtitle</Label>
                            <div class="flex gap-2">
                                <Input
                                    id="subtitle"
                                    v-model="subtitle"
                                    placeholder="Enter a subtitle..."
                                    @keyup.enter="apply"
                                />
                                <Button @click="apply">Apply</Button>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <Button
                                variant="outline"
                                size="sm"
                                @click="
                                    subtitle = 'Welcome back!';
                                    apply();
                                "
                            >
                                "Welcome back!"
                            </Button>
                            <Button
                                variant="outline"
                                size="sm"
                                @click="
                                    subtitle = 'Maintenance scheduled tonight';
                                    apply();
                                "
                            >
                                "Maintenance..."
                            </Button>
                            <Button variant="outline" size="sm" @click="reset">
                                Reset
                            </Button>
                        </div>

                        <p class="text-xs text-muted-foreground">
                            The layout declares
                            <code>useLayoutProps({ subtitle: '' })</code>. Pages
                            override it with <code>setLayoutProps()</code>.
                            Dynamic props auto-reset on navigation.
                        </p>
                    </div>
                </FeatureCard>

                <!-- API Reference -->
                <FeatureCard
                    info-card
                    title="API Reference"
                    description="The complete layout props API."
                >
                    <div class="space-y-3">
                        <div class="space-y-2">
                            <div class="rounded-md bg-muted p-2 text-xs">
                                <p class="font-semibold">In Layout:</p>
                                <pre class="mt-1">
const layout = useLayoutProps({
  subtitle: '',
})</pre
                                >
                            </div>
                            <div class="rounded-md bg-muted p-2 text-xs">
                                <p class="font-semibold">In Page:</p>
                                <pre class="mt-1">
setLayoutProps({
  subtitle: 'Custom subtitle',
})</pre
                                >
                            </div>
                            <div class="rounded-md bg-muted p-2 text-xs">
                                <p class="font-semibold">Reset:</p>
                                <pre class="mt-1">resetLayoutProps()</pre>
                            </div>
                        </div>
                    </div>
                </FeatureCard>
            </div>
        </div>
    </AppLayout>
</template>
