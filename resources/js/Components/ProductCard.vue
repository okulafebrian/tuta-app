<template>
    <Link v-for="product in products" :href="route('shop.shoe', [product.category_id, product])"
        class="bg-white overflow-hidden">
    <div>
        <img :src="'/storage/shoes/' + product.code + '/' + product.photos[0]">
    </div>
    <div class="">
        <p class="text-xs font-medium uppercase">{{ product.category.name }}</p>
        <h4 class="text-sm line-clamp-2 my-2">{{ product.name }}</h4>
        <div v-if="product.discount_price" class="flex flex-col lg:flex-row lg:gap-2">
            <div class="font-semibold">Rp{{ formatNumber(product.discount_price) }}</div>
            <div class="text-gray-400 line-through">Rp{{ formatNumber(product.price) }}</div>
        </div>
        <div v-else>
            <p class="font-semibold">Rp{{ formatNumber(product.price) }}</p>
        </div>
    </div>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    props: {
        products: Object
    },
    methods: {
        formatNumber(number) {
            return number.toLocaleString("id-ID")
        }
    }
}
</script>

<style lang="scss" scoped></style>