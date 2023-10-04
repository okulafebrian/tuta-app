<template>
    <GuestLayout>
        <div class="py-24">
            <div class="fixed bg-white h-full">
                <h2 class="text-xl font-semibold mb-6">Semua Produk</h2>
                <div class="space-y-2">
                    <Link :href="route('shop.category', category)" v-for="category in $page.props.categories"
                        class="block font-medium">{{ category.name }}</Link>
                </div>
            </div>
            <div class="flex justify-end">
                <div class="w-4/5 grid grid-cols-4 gap-6 ">
                    <ProductCard :products="shoes" />
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import ProductCard from "@/Components/ProductCard.vue"
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        GuestLayout, ProductCard, Link
    },
    props: {
        shoes: Object
    }
}
</script>

<style lang="scss" scoped></style>