<template>
    <div class="h-screen flex flex-col">
        <UserNavbar />

        <div class="relative pt-16 flex-1">
            <slot />
        </div>

        <Footer />
    </div>
</template>

<script>
import UserNavbar from '@/Components/Navbar/User.vue'
import Footer from '@/Components/Footer.vue'
import { CheckCircleIcon } from '@heroicons/vue/20/solid'

export default {
    components: {
        UserNavbar, Footer, CheckCircleIcon
    },
    methods: {
        contact() {
            const text = 'Halo TUTA, saya mau beli produk dari katalog toko: https://tuta.co.id/'
            const encodedNotif = encodeURIComponent(text)
            const url = `http://wa.me/+6281110019979?text=${encodedNotif}`
            window.open(url, '_blank');
        },
    },
}

</script>
