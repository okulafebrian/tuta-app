<template>
    <TransitionRoot appear :show="isOpen" as="template" @after-leave="afterModalClosed">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0">
                <div class="flex h-screen justify-center items-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-[35%] rounded-md overflow-y-auto flex flex-col p-6 my-12 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="text-center text-xl font-semibold">
                                Tambah Kategori
                            </DialogTitle>
                            <div class="flex-1 my-6 space-y-6">
                                <input v-model="form.name" type="text" class="border-gray-300 rounded-lg w-full text-sm"
                                    placeholder="Tulis nama kategori disini">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" @click="closeModal" class="px-6 py-2 border rounded font-medium">
                                    Batal
                                </button>
                                <button type="button" @click="addCategory"
                                    class="px-6 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded font-medium">
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
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon
    },
    props: {
        isOpen: Boolean,
    },
    methods: {
        afterModalClosed() {
            this.form.reset();
        },
        closeModal() {
            this.$emit('closeModal')
        },
        addCategory() {
            this.form.post(route('categories.store'), {
                onSuccess: () => this.closeModal(),
                preserveState: false
            });
        },
    },
    setup() {
        const form = useForm({
            name: ''
        })

        return { form }
    }
}
</script>

<style lang="scss" scoped></style>