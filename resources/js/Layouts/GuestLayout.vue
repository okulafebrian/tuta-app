<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';

</script>

<template>
    <div>
        <Navbar />

        <div>
            <slot />
        </div>

        <Footer />
    </div>
</template>
