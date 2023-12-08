<template>
    <div>
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="close" class="relative z-10">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                    leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-50" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex h-full overflow-hidden">
                        <TransitionChild as="template" enter="-translate-x-full duration-200 ease-out"
                            leave="-translate-x-full duration-200 ease-out">
                            <DialogPanel
                                class="w-[70%] h-full transform overflow-hidden bg-white text-left align-middle shadow-xl transition-all">
                                <div class="h-full divide-y">
                                    <div class="flex justify-center p-6 pb-4">
                                        <Link :href="route('home')">
                                        <Logo class="h-8" />
                                        </Link>
                                    </div>

                                    <div v-for="category in this.$page.props.categories">
                                        <Link :href="route('shop.category', category)" @click="close"
                                            class="flex justify-between items-center px-6 py-4">
                                        <div class="font-medium">{{ category.name }}</div>
                                        <ChevronRightIcon class="w-5 h-5 text-gray-500" />
                                        </Link>
                                    </div>

                                    <div class="absolute bottom-0 left-0 right-0 divide-y">
                                        <div v-if="$page.props.auth.user">
                                            <Link :href="route('account')" @click="close"
                                                class="flex justify-between items-center px-6 py-4">
                                            <div class="font-medium">Akun Saya</div>
                                            <ChevronRightIcon class="w-5 h-5 text-gray-500" />
                                            </Link>
                                        </div>
                                        <div v-if="$page.props.auth.user" class="px-6 py-4">
                                            <Link :href="route('logout')" method="post" as="button"
                                                class="flex xl:hidden justify-center items-center gap-2 font-medium border border-lime-600 text-lime-600 rounded-full py-2.5 w-full">
                                            <div>Keluar</div>
                                            <ArrowLeftOnRectangleIcon class="w-5 h-5 stroke-2" />
                                            </Link>
                                        </div>
                                        <div v-else class="px-6 py-4 space-y-3">
                                            <div>
                                                <Link :href="route('logout')" method="post" as="button"
                                                    class="xl:hidden font-medium border border-lime-600 text-lime-600 rounded-full py-2.5 text-center w-full">
                                                Daftar
                                                </Link>
                                            </div>
                                            <div>
                                                <Link :href="route('logout')" method="post" as="button"
                                                    class="xl:hidden font-medium bg-lime-600 text-white rounded-full py-2.5 text-center w-full">
                                                Masuk
                                                </Link>
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
    </div>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { ChevronRightIcon, ShoppingCartIcon, XMarkIcon } from '@heroicons/vue/20/solid';
import { ArrowLeftOnRectangleIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            search: this.$page.props.search ?? '',
        }
    },
    components: {
        TransitionRoot, TransitionChild,
        Dialog, DialogPanel, DialogTitle,
        ChevronRightIcon, ArrowLeftOnRectangleIcon, ShoppingCartIcon, MagnifyingGlassIcon,
        XMarkIcon
    },
    props: {
        isOpen: Boolean
    },
    methods: {
        close() {
            this.$emit('closeModal')
        },
        filter() {
            if (this.search) {
                this.$inertia.get(route('shop'), {
                    search: this.search,
                }, {
                    preserveState: true
                })
            } else {
                this.$inertia.get(route('shop'))
            }

            this.close()
        },
        removeFilter() {
            this.search = ''
            this.$inertia.get(route('shop'))
            this.close()
        },
    },
}
</script>

<style lang="scss" scoped></style>