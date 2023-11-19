<template>
    <div class="h-screen flex flex-col">
        <UserNavbar />

        <div class="relative pt-[68px] pb-20 flex-1">
            <slot />
        </div>

        <Footer />

        <div class="fixed right-0 bottom-0 m-6">
            <button type="button" @click="contact" class="rounded-full">
                <img src="/storage/assets/whatsapp.png" class="rounded-full shadow-lg drop-shadow-lg hover:brightness-90"
                    width="64">
            </button>
        </div>
    </div>
</template>

<script>
import UserNavbar from '@/Components/Navbar/User.vue';
import Footer from '@/Components/Footer.vue';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
    components: {
        UserNavbar, Footer, CheckCircleIcon
    },
    methods: {
        contact() {
            const text = 'Halo TUTA, saya mau beli produk dari katalog toko: https://tuta.co.id/'
            const encodedMessage = encodeURIComponent(text)
            const url = `http://wa.me/+6281110019979?text=${encodedMessage}`
            window.open(url, '_blank');
        },
    },
}

</script>
