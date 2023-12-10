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
                            class="w-[35%] rounded-md overflow-y-auto flex flex-col p-6 my-12 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="text-center text-xl font-semibold">
                                Atur Pengiriman
                            </DialogTitle>
                            <div class="flex-1 my-4 space-y-6">
                                <div class="text-sm ">
                                    <div class="font-semibold mb-2">Alamat Toko</div>
                                    <div>{{ form.address.detail }}</div>
                                    <div>{{ form.address.district.name }}, {{ form.address.city.name }}</div>
                                </div>
                                <div class="text-sm">
                                    <div class="font-semibold mb-2">Tanggal dan Waktu Pickup</div>
                                    <div class="space-y-3">
                                        <DatePicker @updateDate="handleDateChange" />
                                        <div class="grid grid-cols-2 gap-2">
                                            <label for="afternoon"
                                                class="flex items-center gap-3 border rounded px-3 py-2 cursor-pointer">
                                                <input id="afternoon" type="radio" v-model="form.time" value="afternoon"
                                                    class="border-gray-300">
                                                <div>13:00 - 17:59</div>
                                            </label>
                                            <label for="evening"
                                                class="flex items-center gap-3 border rounded px-3 py-2 cursor-pointer">
                                                <input id="evening" type="radio" v-model="form.time" value="evening"
                                                    class="border-gray-300">
                                                <div>18:00 - 23:00</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" @click="closeModal" class="px-6 py-2 border rounded font-medium">
                                    Batal
                                </button>
                                <button type="button" @click="createShipping" :disabled="!validateForm"
                                    class="px-6 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded font-medium disabled:bg-slate-200 disabled:text-slate-500">
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
import DatePicker from '@/Components/DatePicker.vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon,
        DatePicker
    },
    props: {
        isOpen: Boolean,
        order: Object
    },
    computed: {
        validateForm() {
            return this.form.time !== ''
        }
    },
    methods: {
        handleDateChange(day, month, year) {
            this.form.day = day;
            this.form.month = month
            this.form.year = year
        },
        closeModal() {
            this.$emit('closeModal')
        },
        createShipping() {
            this.form.post(route('shipping.store', this.order), {
                onSuccess: () => {
                    this.form.reset()
                    this.closeModal()
                }
            });
        },
    },
    watch: {
        isOpen() {
            this.form.address = this.$page.props.address
            this.form.order = this.order
        }
    },
    setup() {
        const date = new Date()

        const form = useForm({
            day: date.getDate(),
            month: date.getMonth() + 1,
            year: date.getFullYear(),
            time: '',
            order: '',
            address: ''
        })

        return { form }
    }
}
</script>

<style lang="scss" scoped></style>