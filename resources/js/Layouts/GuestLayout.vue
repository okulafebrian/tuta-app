<script setup>
import Navbar from '@/Components/Navbar.vue';
</script>

<template>
    <div>
        <Navbar />

        <div class="px-20">
            <slot />
        </div>
    </div>
</template>
