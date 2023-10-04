<template>
    <GuestLayout>
        <div class="py-24">
            <div class="flex gap-8">
                <div class="w-2/5">
                    <div class="flex gap-4">
                        <div class="space-y-1 w-16">
                            <img @click="selectPhoto(index)" v-for="(photo, index) in shoe.photos"
                                :src="'/storage/shoes/' + shoe.code + '/' + photo"
                                class="rounded-md overflow-hidden hover:brightness-90"
                                :class="{ 'brightness-90': selectedPhotoIndex === index }">
                        </div>
                        <div class="w-4/5">
                            <img :src="selectedPhotoUrl">
                        </div>
                    </div>
                </div>
                <div class="w-3/5">
                    <p class="text-xs font-medium uppercase">{{ shoe.category.name }}</p>
                    <h4 class="text-xl font-medium my-2">{{ shoe.name }}</h4>
                    <div v-if="shoe.discount_price" class="flex gap-2 text-lg mb-6">
                        <div class="font-semibold">Rp{{ formatNumber(shoe.discount_price) }}</div>
                        <div class="text-gray-400 line-through">Rp{{ formatNumber(shoe.price) }}</div>
                    </div>
                    <div v-else>
                        <p class="font-semibold">Rp{{ formatNumber(shoe.price) }}</p>
                    </div>
                    <p class="text-sm select-none mb-6">{{ shoe.description }}</p>
                    <div class="mb-6">
                        <div class="text-sm font-medium mb-2">Warna</div>
                        <div class="flex gap-2">
                            <div v-for="color in colors" class="flex border rounded-lg px-2 py-1">
                                <!-- <input :id="color.id" type="radio" :value="color.id"
                                    class="w-5 h-5 mr-2 bg-white border-gray-300 focus:ring-transparent">
                                <label :for="color.id" class="text-sm">
                                    {{ color.name }}
                                </label> -->
                                {{ color.name }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm font-medium mb-2">Ukuran</div>
                        <div class="flex gap-2">
                            <div v-for="size in sizes" class="flex border rounded-lg px-2 py-1">
                                {{ size.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {
            selectedPhotoIndex: 0
        };
    },
    components: {
        GuestLayout, Link
    },
    props: {
        shoe: Object,
        colors: Object,
        sizes: Object
    },
    computed: {
        selectedPhotoUrl() {
            return '/storage/shoes/' + this.shoe.code + '/' + this.shoe.photos[this.selectedPhotoIndex];
        },
    },
    methods: {
        formatNumber(number) {
            return number.toLocaleString("id-ID")
        },
        selectPhoto(index) {
            this.selectedPhotoIndex = index;
        },
    }
}
</script>

<style lang="scss" scoped></style>