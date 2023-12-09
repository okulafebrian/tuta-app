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
                    class="inline-block bg-lime-600 hover:bg-lime-700 text-white text-lg xl:text-xl font-semibold py-4 px-8 rounded-full">
                Belanja Sekarang
                </Link>
            </div>
        </div>
    </div>

    <div v-if="collection" class="px-4 xl:px-16 py-20 xl:py-32">
        <div class="text-2xl xl:text-3xl text-center font-bold mb-10 xl:mb-14">Rekomendasi Untuk Anda</div>
        <div class="overflow-x-auto">
            <div class="grid grid-cols-5 gap-4 min-w-max xl:min-w-full">
                <div v-for="product in collection.products" class="w-48 xl:w-full">
                    <ProductCard :product="product" />
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 xl:grid-cols-3 gap-16 px-4 xl:px-16 py-20 xl:py-32 bg-slate-100">
        <div class="flex xl:flex-col gap-8 text-zinc-500">
            <img src="/storage/assets/quality.png" class="w-16 h-16 xl:w-20 xl:h-20">
            <div>
                <div class="text-lg font-bold mb-2">Kualitas Premium</div>
                <div>
                    Produk impor dari China yang sudah terjamin memiliki bahan berkualitas
                </div>
            </div>
        </div>
        <div class="flex xl:flex-col gap-8 text-zinc-500">
            <img src="/storage/assets/payment.png" class="w-16 h-16 xl:w-20 xl:h-20">
            <div>
                <div class="text-lg font-bold mb-2">Tersedia COD</div>
                <div>
                    Kami menyediakan berbagai metode pembayaran non-tunai dan pembayaran di rumah (COD)
                </div>
            </div>
        </div>
        <div class="flex xl:flex-col gap-8 text-zinc-500">
            <img src="/storage/assets/deliver.png" class="w-16 h-16 xl:w-20 xl:h-20">
            <div>
                <div class="text-lg font-bold mb-2">Pengiriman Cepat dan Aman</div>
                <div>
                    Kami bekerja sama dengan J&T untuk memberikan layanan pengiriman dengan jangkauan nasional
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 xl:px-16 py-20 xl:py-32 text-center">
        <div class="text-2xl xl:text-3xl text-center font-bold mb-10 xl:mb-20">Telah Diliput Oleh</div>

        <div class="flex flex-col xl:flex-row gap-10 justify-between">
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.liputan6.com/jateng/read/5403768/ramai-ramai-anak-muda-pilih-sneakers-ternyata-ini-alasannya">
                    <img src="/storage/assets/liputan-6.webp" alt="Liputan6" class="max-w-none h-7">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.idxchannel.com/economics/sandal-brand-lokal-ini-gandeng-pabrik-sepatu-terbesar-di-taizhou-china">
                    <img src="/storage/assets/idx-channel.webp" alt="IDX Channel" class="max-w-none h-10">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://voi.id/berita/315095/sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/voi.webp" alt="VOI" class="max-w-none h-11">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://www.tvonenews.com/lifestyle/155117-sneakers-dan-sandal-brand-lokal-ini-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/tv-one-news.webp" alt="tvOneNews" class="max-w-none h-6">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://jurnalpost.com/brand-tuta-luncurkan-sneakers-dan-sandal-high-quality-terbaru-di-2023/59475/">
                    <img src="/storage/assets/jurnal-post.webp" alt="JurnalPost" class="max-w-none h-10">
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a target="_blank"
                    href="https://era.id/lifestyle/137491/sneakers-dan-sandal-brand-lokal-jadi-incaran-anak-muda-kekinian">
                    <img src="/storage/assets/era-id.webp" alt="Era.id" class="max-w-none h-10">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import ProductCard from '@/Components/ProductCard.vue';

export default {
    components: {
        ProductCard
    },
    props: {
        products: Object,
        collection: Object,
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>