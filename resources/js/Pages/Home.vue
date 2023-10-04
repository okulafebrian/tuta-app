<template>
    <GuestLayout>
        <div class="py-24">
            <div class="bg-lime-100 p-6 rounded-xl mb-10">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-1">TUTA OFFICIAL SHOP</h2>
                    <p class="text-sm">Sepatu cantik membuat anda lebih produktif</p>
                </div>
                <Link :href="route('shop.index')"
                    class="py-2 px-4 text-sm rounded-full bg-lime-500 hover:bg-lime-600 font-medium text-white">
                Belanja sekarang
                </Link>
            </div>
            <div class="grid grid-cols-5 gap-10 mb-10">
                <Link :href="route('shop.category', category)" v-for="category in categories"
                    class="border rounded-lg overflow-hidden p-4">
                <img :src="'/storage/assets/' + category.photo" class="w-32 mx-auto">
                <p class="text-center font-medium mt-4">{{ category.name }}</p>
                </Link>
            </div>

            <div>
                <h2 class="text-2xl font-semibold mb-4">Berita</h2>
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <a class="border rounded-lg p-4 flex items-center gap-4" target="_blank"
                        href="https://www.liputan6.com/jateng/read/5403768/ramai-ramai-anak-muda-pilih-sneakers-ternyata-ini-alasannya">
                        <p class="line-clamp-2">Ramai-Ramai Anak Muda Pilih Sneakers, Ternyata Ini Alasannya</p>
                        <img src="/storage/assets/Liputan6.png" class="h-16 w-auto" alt="">
                    </a>
                    <a class="border rounded-lg p-4 flex items-center gap-4" target="_blank"
                        href="https://www.idxchannel.com/economics/sandal-brand-lokal-ini-gandeng-pabrik-sepatu-terbesar-di-taizhou-china">
                        <p class="line-clamp-2">Sandal Brand Lokal Ini Gandeng Pabrik Sepatu Terbesar di Taizhou China</p>
                        <img src="/storage/assets/IDX_Channel.png" class="h-16 w-auto" alt="">
                    </a>
                    <a class="border rounded-lg p-4 flex items-center gap-4" target="_blank"
                        href="https://voi.id/amp/315095/sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                        <p class="line-clamp-2">Sneakers dan Sandal Brand Lokal Ini Jadi Incaran Anak Muda Kekinian</p>
                        <img src="/storage/assets/VOI.jpg" class="h-16 w-auto" alt="">
                    </a>
                    <a class="border rounded-lg p-4 flex items-center gap-4" target="_blank"
                        href="https://www.tvonenews.com/lifestyle/155117-sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                        <p class="line-clamp-2">Sneakers dan Sandal Brand Lokal Ini Jadi Incaran Anak Muda Kekinian</p>
                        <img src="/storage/assets/tvone.jpg" class="h-16 w-auto" alt="">
                    </a>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import { Head, Link } from '@inertiajs/vue3';

export default {
    components: {
        GuestLayout, Head, Link
    },
    props: {
        shoes: Object,
        categories: Object,
    },
    methods: {
        formattedPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>

<style lang="scss" scoped></style>