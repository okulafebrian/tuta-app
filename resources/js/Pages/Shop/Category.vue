<template>
    <Head :title="category.name" />

    <div class="px-4 xl:px-16 pt-6 xl:pt-10">
        <div class="text-xl xl:text-2xl font-semibold mb-6">
            {{ category.name }} ({{ shoes.length }})
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-5 gap-x-4 gap-y-8">
            <div v-for="shoe in shoes">
                <ShoeCard :shoe="shoe" :category="category" />
            </div>
        </div>
    </div>
</template>

<script>
import ShoeCard from "@/Components/ShoeCard.vue"
import UserLayout from "@/Layouts/UserLayout.vue";

export default {
    components: {
        ShoeCard
    },
    props: {
        category: Object,
        shoes: Object,
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>