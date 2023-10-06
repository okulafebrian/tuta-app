<template>
    <div class="p-4 pt-12 sm:px-20 text-white bg-lime-600/90">
        <div class="lg:flex justify-between mb-10">
            <div class="flex-grow grid grid-cols-2 mb-10 lg:mb-0">
                <div>
                    <h5 class="font-semibold mb-3">Produk</h5>
                    <div class="space-y-2 text-lime-100 text-sm">
                        <div v-for="category in $page.props.categories">
                            <Link :href="route('shop.category', category)">{{ category.name }}</Link>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold mb-3">Informasi</h5>
                    <div class="space-y-2 text-lime-100 text-sm">
                        <div>Tentang kami</div>
                        <div>Pembayaran</div>
                        <div>Pengiriman</div>
                    </div>
                </div>
            </div>
            <!-- <div>
                <h5 class="font-semibold mb-3">Ikuti Kami</h5>
                <div class="space-y-2 text-lime-100 text-sm">
                    <Link class="bg-white rounded-full w-10 h-10 flex items-center justify-center">
                    <img src="/storage/assets/tiktok.png" class="w-5 h-5">
                    </Link>
                </div>
            </div> -->
        </div>


        <div class="text-xs">
            © 2023 PT TUTA MANDIRI INDONESIA
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<style lang="scss" scoped></style>