<template>
    <nav class="sm:px-20 px-4 py-3 bg-white shadow-sm fixed z-20 top-0 w-full">
        <div class="flex items-center justify-between gap-10">
            <Link :href="route('home')">
            <img src=" /storage/assets/logo.png" alt="TUTA" class="w-auto h-6">
            </Link>

            <Link :href="route('cart')" class="rounded-full hover:bg-gray-100 p-2">
            <ShoppingCartIcon class="w-5 h-5 stroke-2" />
            </Link>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ShoppingCartIcon } from '@heroicons/vue/24/outline'
</script>

<style lang="scss" scoped></style>