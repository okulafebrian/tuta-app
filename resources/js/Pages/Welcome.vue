<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="h-screen flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold mb-5 text-lime-950 ">This site is under development</h1>
            <p class="text-3xl text-lime-950 font-medium">Stay tune for our launch!</p>
        </div>
    </div>
</template>
