<template>
    <div class="h-screen flex flex-col">
        <Navbar />

        <div class="relative flex-grow bg-slate-100">
            <slot />
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Navbar/Admin.vue'

export default {
    components: {
        Navbar
    },
}

</script>
