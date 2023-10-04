<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-10">
            <h2 class="text-xl font-semibold">Dashboard</h2>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>