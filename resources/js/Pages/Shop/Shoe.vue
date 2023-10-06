<template>
    <Head :title="shoe.name" />

    <GuestLayout>
        <div class="px-4 lg:px-20 py-24">
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-12">
                <div class="overflow-hidden">
                    <div>
                        <img :src="selectedPhotoUrl">
                    </div>
                    <div class="relative overflow-hidden">
                        <div class="overflow-hidden">
                            <div class="flex space-x-4 overflow-x-auto md:overflow-hidden">
                                <div v-for="(photo, index) in shoe.photos" @click="selectPhoto(index)" class="flex-grow">
                                    <img :src="'/storage/shoes/' + shoe.code + '/' + photo"
                                        class="rounded-md overflow-hidden hover:brightness-90 max-w-none h-24"
                                        :class="{ 'brightness-90': selectedPhotoIndex === index }">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-semibold text-zinc-400 uppercase mb-2">
                        {{ shoe.category.name }}
                    </p>
                    <h4 class="text-lg mb-2">
                        {{ shoe.name }}
                    </h4>
                    <div class="flex gap-2 text-xl">
                        <div class="font-semibold">
                            Rp{{ formatNumber(shoe.discount_price ?? shoe.price) }}
                        </div>
                        <div v-if="shoe.discount_price" class="text-gray-500 line-through">
                            Rp{{ formatNumber(shoe.price) }}
                        </div>
                    </div>

                    <hr class="my-4">

                    <div>
                        <h4 class="font-semibold mb-2">Deskripsi Produk</h4>
                        <div v-if="more">
                            <div v-html="shoe.description" class="prose select-none text-sm mb-2"></div>
                            <button @click="readMore" type="button"
                                class="font-semibold text-lime-600 hover:text-lime-600 text-sm">
                                Sembunyikan
                            </button>
                        </div>
                        <div v-else>
                            <div v-html="shoe.description" class="prose select-none text-sm line-clamp-4 mb-2"></div>
                            <button @click="readMore" type="button"
                                class="font-semibold text-lime-600 hover:text-lime-600 text-sm">
                                Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="lg:hidden">

                <div>
                    <form @submit.prevent="form.post(route('cart.add'))">
                        <div class="mb-6">
                            <div class="font-medium mb-2">Pilih Warna</div>
                            <div class="grid grid-cols-2 gap-2">
                                <div v-for="color in colors">
                                    <input v-model="form.color" :id="'c' + color.id" :value="color.id" type="radio"
                                        class="hidden peer">
                                    <label :for="'c' + color.id"
                                        class="border rounded-md block text-center py-2 peer-checked:ring-1 peer-checked:ring-black ">
                                        {{ color.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="font-medium mb-2">Pilih Ukuran</div>
                            <div class="grid grid-cols-4 gap-2">
                                <div v-for="size in sizes">
                                    <input v-model="form.size" :id="'s' + size.id" :value="size.id" type="radio"
                                        class="hidden peer">
                                    <label :for="'s' + size.id"
                                        class="border rounded-md block text-center py-2 peer-checked:ring-1 peer-checked:ring-black ">
                                        {{ size.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-8">
                            <div class="font-medium mb-2">Jumlah</div>
                            <input v-model="form.quantity" type="number" class="border border-gray-300 rounded-md">
                        </div>
                        <button type="submit"
                            class="rounded-full bg-lime-600 hover:bg-lime-700 py-3 font-medium text-white w-full">
                            Tambah ke keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            selectedPhotoIndex: 0,
            more: 0,
        };
    },
    components: {
        GuestLayout, Link, Head, useForm
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
        readMore() {
            this.more = !this.more
        }
    },
    setup(props) {
        const form = useForm({
            shoe_id: props.shoe.id,
            color: '',
            size: '',
            quantity: 1
        })

        return { form }
    }
}
</script>

<style lang="scss" scoped></style>