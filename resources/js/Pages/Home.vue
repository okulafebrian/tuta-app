<template>
    <div class="py-10 xl:py-0 xl:h-screen bg-lime-200/80 flex justify-center items-center">
        <div class="text-lime-700">
            <div class="text-center text-lg xl:text-2xl font-medium">Koleksi Sepatu Wanita Kekinian</div>
            <div class="text-center text-6xl xl:text-8xl font-['League_Spartan'] my-10">
                <div>kualitas premium</div>
                <div>harga terjangkau</div>
            </div>
            <div class="text-center">
                <Link :href="route('shop')"
                    class="inline-block bg-lime-600 hover:bg-lime-700 text-white text-lg xl:text-xl font-medium py-4 px-8 rounded-full">
                Belanja Sekarang
                </Link>
            </div>
        </div>
    </div>

    <div class="mx-4 xl:mx-10 my-8 xl:my-20">
        <div class="grid xl:grid-cols-5 gap-4">
            <Link :href="route('shop.category', category)" v-for="category in categories"
                class="flex flex-row-reverse xl:flex-col justify-between items-center bg-gray-200/50 px-6">
            <div>
                <img :src="'/storage/assets/' + category.photo" class="w-36 xl:w-auto xl:py-4 brightness-95">
            </div>
            <div class="text-center text-lg font-medium my-3">{{ category.name }}</div>
            </Link>
        </div>
    </div>

    <div class="mx-4 xl:mx-10 my-20 xl:my-40">
        <div class="text-2xl xl:text-3xl text-center font-bold mb-10 xl:mb-20">Telah Diliput Oleh</div>

        <div class="grid grid-cols-2 xl:grid-cols-3 gap-16 mx-4 xl:mx-36">
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.liputan6.com/jateng/read/5403768/ramai-ramai-anak-muda-pilih-sneakers-ternyata-ini-alasannya">
                    <img src="/storage/assets/liputan-6.webp" alt="Liputan6" class="xl:max-w-none xl:h-8">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.idxchannel.com/economics/sandal-brand-lokal-ini-gandeng-pabrik-sepatu-terbesar-di-taizhou-china">
                    <img src="/storage/assets/idx-channel.webp" alt="IDX Channel" class="xl:max-w-none xl:h-12">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://voi.id/berita/315095/sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/voi.webp" alt="VOI" class="xl:max-w-none xl:h-12">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.tvonenews.com/lifestyle/155117-sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/tv-one-news.webp" alt="tvOneNews" class="xl:max-w-none xl:h-6">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://jurnalpost.com/brand-tuta-luncurkan-sneakers-dan-sandal-high-quality-terbaru-di-2023/59475/">
                    <img src="/storage/assets/jurnal-post.webp" alt="JurnalPost" class="xl:max-w-none xl:h-12">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://era.id/lifestyle/137491/sneakers-dan-sandal-brand-lokal-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/era-id.webp" alt="Era.id" class="xl:max-w-none xl:h-12">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import ShoeCard from '@/Components/ShoeCard.vue';

export default {
    components: {
        ShoeCard
    },
    props: {
        shoes: Object,
        categories: Object
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>