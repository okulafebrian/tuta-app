<template>
    <div>
        <Link :href="route('shop.shoe', [category, shoe])">
        <div class="mb-4">
            <img :src="'/storage/shoes/' + shoe.code + '/' + shoe.photo + '/' + shoe.mainPhoto">
        </div>
        <div class="text-center space-y-1">
            <div class="line-clamp-2 text-sm">{{ shoe.name }}</div>
            <div class="font-medium">
                Rp {{ (shoe.is_discount ? shoe.discount_price : shoe.price).toLocaleString("id-ID") }}
            </div>
            <div v-if="shoe.is_discount" class="flex items-center justify-center gap-2">
                <div class="font-semibold bg-rose-100 text-rose-600 rounded-md px-2 py-0.5 text-xs">
                    {{ shoe.discount }}%
                </div>
                <div class="text-gray-400 line-through text-sm">
                    Rp {{ shoe.price.toLocaleString("id-ID") }}
                </div>
            </div>
        </div>
        </Link>
    </div>
</template>

<script>
export default {
    props: {
        category: Object,
        shoe: Object
    },
}
</script>

<style lang="scss" scoped></style>