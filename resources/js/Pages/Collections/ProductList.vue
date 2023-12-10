<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0">
                <div class="flex h-screen justify-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-[60%] rounded-md overflow-y-auto flex flex-col px-6 py-8 my-12 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="text-center text-xl font-semibold">
                                Tambah Produk
                            </DialogTitle>
                            <div class="flex-1 my-6">
                                <table class="w-full">
                                    <thead class="border-y">
                                        <tr class="text-left text-xs font-semibold">
                                            <td class="py-4 ps-6 w-0"></td>
                                            <td class="py-4 px-6">NAMA PRODUK</td>
                                            <td class="py-4 px-6">HARGA</td>
                                            <td class="py-4 px-6">PENJUALAN</td>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <tr v-for="product in products" :key="product.id">
                                            <td class="py-4 ps-6">
                                                <input type="checkbox" class="rounded w-5 h-5" :value="product"
                                                    :id="'product' + product.id" v-model="selectedProducts">
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <img :src="product.main_photos[0].url"
                                                        class="border rounded p-1 w-16 h-16">
                                                    <div>
                                                        <div class="font-semibold line-clamp-2">{{ product.name }}</div>
                                                        <div class="text-xs">{{ product.category.name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                Rp{{ product.price.toLocaleString("id-ID") }}
                                            </td>
                                            <td class="py-4 px-6">
                                                2
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" @click="closeModal"
                                    class="px-8 py-2 border rounded text-sm font-medium">
                                    Batal
                                </button>
                                <button type="button" @click="selectProduct"
                                    class="px-8 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded text-sm font-medium">
                                    Simpan
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            selectedProducts: this.selected
        }
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon
    },
    props: {
        products: Object,
        selected: Object,
        isOpen: Boolean,
    },
    methods: {
        closeModal() {
            this.$emit('closeModal', null)
        },
        selectProduct() {
            this.$emit('closeModal', this.selectedProducts)
        },
    }
}
</script>

<style lang="scss" scoped></style>