<template>
    <nav class="bg-white">
        <div class="px-20 py-3 flex justify-between">
            <div class="flex items-center">
                <img src="/storage/assets/logo.png" alt="TUTA" class="w-auto h-7">
                <div class="flex gap-6 ml-12 text-sm font-semibold">
                    <Link :href="route('dashboard')">Dashboard</Link>
                    <!-- <Link :href="route('orders')">Pesanan</Link> -->
                    <Link :href="route('shoes.index')">Produk</Link>
                </div>
            </div>
            <div class="flex gap-6 items-center font-semibold text-sm">
                <Link :href="route('logout')" method="post" as="button">Logout</Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style lang="scss" scoped></style>