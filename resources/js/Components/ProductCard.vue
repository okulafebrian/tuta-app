<template>
    <Link :href="route('shop.product', [product.category, product])" class="block h-full border rounded-xl">
    <div class="p-4 pb-0">
        <img :src="product.main_photos[0].url">
    </div>
    <div class="p-4">
        <div class="line-clamp-2 text-sm mb-1">{{ product.name }}</div>
        <div class="flex flex-col xl:flex-row xl:gap-2">
            <div class="font-bold" :class="{ 'text-red-600': product.is_discount }">
                Rp{{ (product.is_discount ? product.discount_price : product.price).toLocaleString("id-ID") }}
            </div>
            <div v-if="product.is_discount" class="text-slate-400 line-through font-medium text-xs xl:text-base">
                Rp{{ product.price.toLocaleString("id-ID") }}
            </div>
        </div>
    </div>
    </Link>
</template>

<script>
export default {
    props: {
        product: Object
    }
}
</script>

<style lang="scss" scoped></style>