<template>
    <Head title="Semua Produk" />

    <div class="px-4 xl:px-16 pt-6 xl:pt-10">
        <div class="text-xl xl:text-2xl font-semibold mb-6">
            {{ search ?? 'Semua Produk' }} ({{ shoes.length }})
        </div>


        <div class="grid grid-cols-2 xl:grid-cols-5 gap-x-4 gap-y-8">
            <div v-for="shoe in shoes">
                <ShoeCard :shoe="shoe" :category="shoe.category" />
            </div>
        </div>
    </div>
</template>

<script>
import ShoeCard from "@/Components/ShoeCard.vue"
import UserLayout from "@/Layouts/UserLayout.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        ShoeCard, MagnifyingGlassIcon
    },
    props: {
        shoes: Object,
        search: String,
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>