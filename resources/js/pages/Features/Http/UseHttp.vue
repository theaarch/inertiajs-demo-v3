<script setup lang="ts">
import { Head, useHttp } from '@inertiajs/vue3';
import { ref } from 'vue';
import FeatureCard from '@/components/FeatureCard.vue';
import FeatureHeader from '@/components/FeatureHeader.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { useHttpApi } from '@/wayfinder/App/Http/Controllers/Feature/HttpController';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'HTTP' }, { title: 'useHttp' }];

const form = useHttp({ name: '' });
const response = ref<Record<string, unknown> | null>(null);
const cancelled = ref(false);

async function submitForm() {
    cancelled.value = false;
    try {
        await form.post(useHttpApi.url(), {
            onSuccess: (res: unknown) => {
                response.value = res as Record<string, unknown>;
            },
        });
    } catch {
        // Errors handled via form.errors
    }
}

function cancelRequest() {
    form.cancel();
    cancelled.value = true;
}
</script>

<template>
    <Head title="useHttp" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-4">
            <FeatureHeader
                title="useHttp"
                docs="the-basics/http-requests"
                controller="app/Http/Controllers/Feature/HttpController.php#L13"
            >
                Non-Inertia HTTP requests with
                <code class="text-xs">useHttp()</code>. Like
                <code class="text-xs">useForm()</code> but returns JSON, no page
                visit.
            </FeatureHeader>

            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Demo form -->
                <FeatureCard
                    title="API Request Demo"
                    description="Send a POST request to a JSON endpoint. No page navigation occurs."
                >
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <Label for="name">Your Name</Label>
                            <Input
                                id="name"
                                v-model="form.name"
                                placeholder="Enter your name..."
                            />
                        </div>
                        <div class="flex items-center gap-2">
                            <Button
                                size="sm"
                                :disabled="form.processing"
                                @click="submitForm"
                            >
                                {{
                                    form.processing
                                        ? 'Sending...'
                                        : 'Send Request'
                                }}
                            </Button>
                            <Button
                                v-if="form.processing"
                                variant="destructive"
                                size="sm"
                                @click="cancelRequest"
                            >
                                Cancel
                            </Button>
                            <span
                                v-if="cancelled"
                                class="text-sm text-muted-foreground"
                                >Request cancelled</span
                            >
                        </div>
                    </div>
                </FeatureCard>

                <!-- Reactive state -->
                <FeatureCard info-card title="Reactive State">
                    <template #description>
                        All the state properties from
                        <code class="text-xs">useHttp()</code>.
                    </template>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span>processing</span>
                            <Badge
                                :variant="
                                    form.processing ? 'default' : 'secondary'
                                "
                                >{{ form.processing }}</Badge
                            >
                        </div>
                        <div class="flex items-center justify-between">
                            <span>isDirty</span>
                            <Badge
                                :variant="
                                    form.isDirty ? 'default' : 'secondary'
                                "
                                >{{ form.isDirty }}</Badge
                            >
                        </div>
                        <div class="flex items-center justify-between">
                            <span>wasSuccessful</span>
                            <Badge
                                :variant="
                                    form.wasSuccessful ? 'default' : 'secondary'
                                "
                                >{{ form.wasSuccessful }}</Badge
                            >
                        </div>
                        <div class="flex items-center justify-between">
                            <span>recentlySuccessful</span>
                            <Badge
                                :variant="
                                    form.recentlySuccessful
                                        ? 'default'
                                        : 'secondary'
                                "
                                >{{ form.recentlySuccessful }}</Badge
                            >
                        </div>
                        <div class="flex items-center justify-between">
                            <span>hasErrors</span>
                            <Badge
                                :variant="
                                    form.hasErrors ? 'destructive' : 'secondary'
                                "
                                >{{ form.hasErrors }}</Badge
                            >
                        </div>
                    </div>
                </FeatureCard>

                <!-- Response display -->
                <FeatureCard
                    info-card
                    title="Response"
                    description="The JSON response from the API endpoint."
                >
                    <pre
                        v-if="response"
                        class="overflow-auto rounded-lg border border-black/5 bg-neutral-50/80 dark:border-white/5 dark:bg-neutral-900/80 p-3 font-mono text-xs"
                        >{{ JSON.stringify(response, null, 2) }}</pre
                    >
                    <p v-else class="text-xs text-muted-foreground">
                        Send a request to see the response.
                    </p>
                </FeatureCard>

                <!-- Key differences -->
                <FeatureCard
                    info-card
                    title="useHttp vs useForm"
                    description="When to use which."
                >
                    <div class="space-y-3 text-xs">
                        <div class="rounded-md border border-black/10 p-2">
                            <p class="font-semibold">useForm()</p>
                            <p class="text-muted-foreground">
                                Triggers Inertia page visits. Server returns
                                Inertia responses. Page component gets swapped.
                            </p>
                        </div>
                        <div class="rounded-md border-2 border-primary p-2">
                            <p class="font-semibold">useHttp()</p>
                            <p class="text-muted-foreground">
                                Plain HTTP requests. Server returns JSON. No
                                page navigation. Great for API endpoints,
                                toggles, status checks.
                            </p>
                        </div>
                    </div>
                </FeatureCard>
            </div>
        </div>
    </AppLayout>
</template>
