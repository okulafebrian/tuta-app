<template>
    <GuestLayout>
        <div class="px-4 lg:px-20 py-24">
            <div class="bg-lime-200/70 p-6 lg:p-8 rounded-xl mb-8">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-1">TUTA OFFICIAL SHOP</h2>
                    <p class="text-sm">Sepatu cantik membuat anda lebih produktif</p>
                </div>
                <Link :href="route('shop.index')"
                    class="py-2 px-4 text-sm rounded-full bg-lime-500 hover:bg-lime-600 font-medium text-white">
                Belanja sekarang
                </Link>
            </div>

            <div class="relative overflow-hidden mb-16">
                <div class="overflow-hidden">
                    <div class="flex space-x-4 overflow-x-auto md:overflow-hidden">
                        <Link :href="route('shop.category', category)" v-for="category in categories"
                            class="flex-grow border rounded-xl p-4">
                        <img :src="'/storage/assets/' + category.photo" class="max-w-none lg:max-w-full h-24 lg:h-fit">
                        <p class="text-center font-medium mt-4">{{ category.name }}</p>
                        </Link>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-semibold mb-4">Berita</h2>
                <div class="grid sm:grid-cols-3 grid-cols-1 gap-10 text-sm">
                    <a class="flex items-center gap-4" target="_blank"
                        href="https://www.liputan6.com/jateng/read/5403768/ramai-ramai-anak-muda-pilih-sneakers-ternyata-ini-alasannya">
                        <p class="line-clamp-2">Ramai-Ramai Anak Muda Pilih Sneakers, Ternyata Ini Alasannya</p>
                        <img src="/storage/assets/Liputan6.png" class="h-16 w-auto" alt="">
                    </a>
                    <a class="flex items-center gap-4" target="_blank"
                        href="https://www.idxchannel.com/economics/sandal-brand-lokal-ini-gandeng-pabrik-sepatu-terbesar-di-taizhou-china">
                        <p class="line-clamp-2">Sandal Brand Lokal Ini Gandeng Pabrik Sepatu Terbesar di Taizhou China</p>
                        <img src="/storage/assets/IDX_Channel.png" class="h-16 w-auto" alt="">
                    </a>
                    <a class="flex items-center gap-4" target="_blank"
                        href="https://voi.id/amp/315095/sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                        <p class="line-clamp-2">Sneakers dan Sandal Brand Lokal Ini Jadi Incaran Anak Muda Kekinian</p>
                        <img src="/storage/assets/VOI.jpg" class="h-16 w-auto" alt="">
                    </a>
                    <a class="flex items-center gap-4" target="_blank"
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
import Footer from "@/Components/Footer.vue"

export default {
    components: {
        GuestLayout, Head, Link, Footer
    },
    props: {
        shoes: Object,
        categories: Object,
    },
    methods: {
        formattedPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        handleScroll() {
            $('.flex').animate({ scrollLeft: $('.flex').scrollLeft() + 50 }, 200);
        }
    }
}
</script>

<style lang="scss" scoped></style>