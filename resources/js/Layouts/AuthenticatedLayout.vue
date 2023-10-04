<script setup>
import AdminNavbar from '@/Components/AdminNavbar.vue';
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <AdminNavbar />

            <div class="px-20">
                <slot />
            </div>
        </div>
    </div>
</template>
