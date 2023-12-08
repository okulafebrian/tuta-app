<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0 overflow-y-auto">
                <div class="flex items-center justify-center h-screen">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full xl:w-[45%] xl:rounded-md flex flex-col xl:my-6 transform bg-white align-middle shadow-xl transition-all px-4 xl:px-8 py-6">
                            <DialogTitle class="flex justify-between items-center">
                                <div class="text-xl font-semibold">Daftar Alamat</div>
                                <button type="button" @click="closeModal">
                                    <XMarkIcon class="w-6 h-6" />
                                </button>
                            </DialogTitle>
                            <div class="py-6 space-y-4">
                                <label :for="'address' + address.id" v-for="address in addresses"
                                    class=" border rounded-xl p-4 flex items-center justify-between">
                                    <div class="text-sm space-y-1">
                                        <div class="flex justify-between items-center">
                                            <div class="flex-1 flex gap-2 items-center">
                                                <div class="font-semibold">{{ address.name }}</div>
                                                <div v-if="address.is_main"
                                                    class="bg-gray-200 text-gray-600 text-xs font-semibold px-2 rounded">
                                                    Utama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-xs">{{ address.phone_number }}</div>
                                        <div class="text-xs line-clamp-1">{{ address.detail }}</div>
                                    </div>
                                    <input type="radio" v-model="selectedAddress" :id="'address' + address.id"
                                        :value="address" class="w-5 h-5 text-lime-600 focus:ring-lime-600">
                                </label>
                            </div>
                            <div>
                                <button type="button" @click="addAddress"
                                    class="w-full border border-lime-600 hover:border-lime-700 rounded-full py-3 text-lime-600 hover:text-lime-700 font-semibold text-sm">
                                    Tambah Alamat
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
import { XMarkIcon, EllipsisHorizontalIcon, CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
    data() {
        return {
            addresses: null,
            selectedAddress: this.address
        }
    },
    props: {
        address: Object,
        isOpen: Boolean
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon, EllipsisHorizontalIcon, CheckCircleIcon
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
        updateSelection() {
            this.$emit('closeModal', this.selectedAddress)
        },
        addAddress() {
            this.$emit('addAddress')
        }
    },
    watch: {
        isOpen() {
            this.addresses = this.$page.props.auth.user.addresses
        },
        selectedAddress() {
            this.updateSelection()
        }
    }
}
</script>

<style lang="scss" scoped></style>