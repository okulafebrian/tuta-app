<template>
    <Head :title="category.name" />

    <div class="px-4 xl:px-16 py-10">
        <div class="text-xl font-bold mb-6">
            {{ category.name }} ({{ products.length }})
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
            <div v-for="product in products">
                <ProductCard :product="product" />
            </div>
        </div>
    </div>
</template>

<script>
import ProductCard from "@/Components/ProductCard.vue"
import UserLayout from "@/Layouts/UserLayout.vue";

export default {
    components: {
        ProductCard
    },
    props: {
        products: Object,
        category: Object
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>