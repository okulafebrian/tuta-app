<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
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
                            class="w-full xl:w-1/2 xl:rounded-2xl overflow-hidden flex flex-col xl:my-5 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="flex justify-between items-center px-8 py-6">
                                <div class="text-xl xl:text-2xl font-semibold flex-1">
                                    Daftar Alamat
                                </div>
                                <button type="button" @click="closeModal">
                                    <XMarkIcon class="w-6 h-6" />
                                </button>
                            </DialogTitle>
                            <div class="px-8 mb-8 overflow-y-auto">
                                <div class="mb-6">
                                    <button type="button" @click="addAddress"
                                        class="bg-white py-2.5 w-full border border-lime-600/50 rounded-full font-medium text-lime-600 text-center">
                                        Tambah Alamat Baru
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <div v-for="address in addresses">
                                        <input :id="address.id" v-model="selectedAddress" type="radio" :value="address"
                                            class="hidden peer" :checked="selectedAddress.id === address.id">
                                        <div
                                            class="flex p-4 text-sm bg-slate-100 rounded-xl peer-checked:border peer-checked:border-lime-600 peer-checked:bg-lime-300/40">
                                            <div class="flex-1">
                                                <div class="font-medium">{{ address.name }}</div>
                                                <div class="text-sm text-zinc-600">{{ address.phone }}</div>
                                                <div class="text-sm text-zinc-600">{{ address.detail }}</div>
                                            </div>
                                            <label :for="address.id" v-if="selectedAddress.id !== address.id"
                                                class="bg-lime-600 hover:bg-lime-700 font-medium text-white rounded-full px-6 py-2 my-auto cursor-pointer">
                                                Pilih
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
import { XMarkIcon } from '@heroicons/vue/20/solid';

export default {
    data() {
        return {
            selectedAddress: this.$page.props.mainAddress
        }
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon
    },
    methods: {
        closeModal() {
            this.$emit('closeModal', this.selectedAddress)
        },
        addAddress() {
            this.$emit('addAddress')
        }
    },
    watch: {
        selectedAddress() {
            this.closeModal()
        }
    },
    props: {
        addresses: Object,
        isOpen: Boolean,
    },
}
</script>

<style lang="scss" scoped></style>