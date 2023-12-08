<template>
    <Sidebar :isOpen="isOpen" @closeModal="closeModal" />

    <nav class="fixed top-0 z-10 px-4 xl:px-16 py-4 w-full bg-white border-b">
        <div class="flex items-center justify-between gap-6">
            <div class="flex xl:hidden">
                <button type="button" @click="openModal">
                    <Bars3Icon class="w-6 h-6" />
                </button>
            </div>
            <div>
                <Link :href="route('home')">
                <Logo class="h-8" />
                </Link>
            </div>

            <div class="hidden xl:flex gap-6">
                <Link v-for="category in $page.props.categories" :href="route('shop.category', category)"
                    class="block font-medium hover:text-lime-600 text-sm">
                {{ category.name }}
                </Link>
            </div>

            <div v-if="$page.props.auth.user" class="flex gap-4">
                <div>
                    <Link :href="route('carts.index')"
                        class="relative flex items-center justify-center rounded-lg hover:bg-gray-100 xl:p-1">
                    <ShoppingCartIcon class="w-6 h-6" />
                    <div v-if="$page.props.cartQuantity > 0"
                        class="absolute -top-2 xl:-top-1 -right-1 ring-2 ring-white flex items-center justify-center w-3.5 h-3.5 bg-red-600 rounded-full text-white font-bold text-[9px]">
                        <div>{{ $page.props.cartQuantity }}</div>
                    </div>
                    </Link>
                </div>
                <div class="hidden xl:block">
                    <Link :href="route('account')"
                        class="flex items-center justify-center rounded-lg hover:bg-gray-100 p-1">
                    <UserIcon class="w-6 h-6" />
                    </Link>
                </div>
            </div>

            <div v-else class="flex gap-2">
                <div>
                    <Link :href="route('login')"
                        class="bg-lime-600 xl:bg-white xl:border border-lime-600 text-white xl:text-lime-600 text-sm font-medium rounded-full px-3 xl:px-5 py-2">
                    Masuk
                    </Link>
                </div>
                <div class="hidden xl:block">
                    <Link :href="route('register')"
                        class="bg-lime-600 hover:bg-lime-700 text-white text-sm font-medium rounded-full px-5 py-2">
                    Daftar
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import Sidebar from '@/Components/Sidebar/User.vue';
import { ShoppingCartIcon, MagnifyingGlassIcon, Bars3Icon, UserIcon } from '@heroicons/vue/24/outline'
import { XMarkIcon } from '@heroicons/vue/20/solid';

export default {
    data() {
        return {
            search: this.$page.props.search ?? '',
            isOpen: false,
        }
    },
    components: {
        Sidebar,
        ShoppingCartIcon, MagnifyingGlassIcon, Bars3Icon, UserIcon, XMarkIcon
    },
    methods: {
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
        },
        removeFilter() {
            this.search = ''
            this.$inertia.get(route('shop'))
        },
        openModal() {
            this.isOpen = true
        },
        closeModal() {
            this.isOpen = false
        },
    }
}
</script>

<style lang="scss" scoped></style>