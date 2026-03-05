<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import FeatureCard from '@/components/FeatureCard.vue';
import FeatureHeader from '@/components/FeatureHeader.vue';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Layouts & Head' },
    { title: 'Head Component' },
];

const dynamicTitle = ref('Head Component');
const metaDescription = ref('Document head management with Inertia.js');
</script>

<template>
    <Head :title="dynamicTitle">
        <meta
            head-key="description"
            name="description"
            :content="metaDescription"
        />
        <meta head-key="og:title" property="og:title" :content="dynamicTitle" />
    </Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-4">
            <FeatureHeader
                title="Head Component"
                docs="the-basics/title-and-meta#head-component"
                controller="app/Http/Controllers/Feature/LayoutController.php#L21"
            >
                Document <code class="text-xs">&lt;head&gt;</code> management
                with <code class="text-xs">&lt;Head&gt;</code> for titles, meta
                tags, and more.
            </FeatureHeader>

            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Dynamic title -->
                <FeatureCard
                    title="Dynamic Title"
                    description="Change the page title and watch the browser tab update in real time."
                >
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <Label for="title">Page Title</Label>
                            <Input
                                id="title"
                                v-model="dynamicTitle"
                                placeholder="Enter a title..."
                            />
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium">Current:</span>
                            <Badge variant="secondary">{{
                                dynamicTitle
                            }}</Badge>
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Check the browser tab. The title updates reactively.
                        </p>
                    </div>
                </FeatureCard>

                <!-- Meta tags -->
                <FeatureCard
                    info-card
                    title="Meta Tags"
                    description="Manage meta description, OG tags, and more."
                >
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <Label for="description">Meta Description</Label>
                            <Input
                                id="description"
                                v-model="metaDescription"
                                placeholder="Enter a description..."
                            />
                        </div>
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Current meta tags:</p>
                            <pre class="mt-1">
&lt;meta name="description"
  content="{{ metaDescription }}" /&gt;
&lt;meta property="og:title"
  content="{{ dynamicTitle }}" /&gt;</pre
                            >
                        </div>
                    </div>
                </FeatureCard>

                <!-- Title template -->
                <FeatureCard info-card title="Title Template">
                    <template #description>
                        Global title formatting via
                        <code class="text-xs">createInertiaApp</code>.
                    </template>
                    <div class="space-y-3">
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <pre>
createInertiaApp({
  title: (title) =>
    title ? `${title} - ${appName}` : appName,
})</pre
                            >
                        </div>
                        <p class="text-xs text-muted-foreground">
                            This app uses the template above. So
                            <code>&lt;Head title="Home" /&gt;</code> becomes
                            <code>"Home - Laravel"</code> in the browser tab.
                        </p>
                    </div>
                </FeatureCard>

                <!-- head-key dedup -->
                <FeatureCard info-card title="Tag Deduplication">
                    <template #description>
                        Use <code class="text-xs">head-key</code> to prevent
                        duplicate tags.
                    </template>
                    <div class="space-y-3">
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Layout sets defaults:</p>
                            <pre class="mt-1">
&lt;Head&gt;
  &lt;meta head-key="description"
    content="Default" /&gt;
&lt;/Head&gt;</pre
                            >
                        </div>
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Page overrides:</p>
                            <pre class="mt-1">
&lt;Head&gt;
  &lt;meta head-key="description"
    content="Page-specific" /&gt;
&lt;/Head&gt;</pre
                            >
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Only one tag with the same
                            <code>head-key</code> renders. The page-level tag
                            wins.
                        </p>
                    </div>
                </FeatureCard>

                <!-- API reference -->
                <FeatureCard
                    info-card
                    class="lg:col-span-2"
                    title="API Reference"
                >
                    <div class="grid gap-3 sm:grid-cols-3">
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Title shorthand</p>
                            <pre class="mt-1">
&lt;Head title="My Page" /&gt;</pre
                            >
                        </div>
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Full control</p>
                            <pre class="mt-1">
&lt;Head&gt;
  &lt;title&gt;My Page&lt;/title&gt;
  &lt;meta ... /&gt;
&lt;/Head&gt;</pre
                            >
                        </div>
                        <div
                            class="rounded-lg border border-black/5 bg-neutral-50/80 p-3 font-mono text-xs"
                        >
                            <p class="font-semibold">Reset on unmount</p>
                            <pre class="mt-1">
When a page unmounts,
its Head tags are removed
automatically.</pre
                            >
                        </div>
                    </div>
                </FeatureCard>
            </div>
        </div>
    </AppLayout>
</template>
