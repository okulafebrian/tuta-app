<template>
    <Head title="Semua Produk" />

    <GuestLayout>
        <div class="px-4 lg:px-20 py-24">
            <div class="mb-8">
                <Dropdown :options="$page.props.categories">
                    <h4 class="text-xl font-semibold">Semua Produk ({{ shoes.length }})</h4>
                </Dropdown>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-10 gap-x-5 lg:gap-x-10">
                <ProductCard :products="shoes" />
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import ProductCard from "@/Components/ProductCard.vue"
import { Head, Link } from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";

export default {
    components: {
        GuestLayout, ProductCard, Link, Head, Dropdown
    },
    props: {
        shoes: Object
    }
}
</script>

<style lang="scss" scoped></style>