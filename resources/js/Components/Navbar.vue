<template>
    <nav class="px-20 py-3 bg-white border-b fixed top-0 w-full">
        <div class="flex items-center justify-between gap-10">
            <Link :href="route('home')">
            <img src=" /storage/assets/logo.png" alt="TUTA" class="w-auto h-7">
            </Link>
            <button class="rounded-full hover:bg-gray-100 p-2">
                <ShoppingCartIcon class="w-5 h-5 stroke-2" />
            </button>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ShoppingCartIcon } from '@heroicons/vue/24/outline'
</script>

<style lang="scss" scoped></style>