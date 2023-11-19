<template>
    <SidebarMenu :isOpen="isOpen" @closeModal="closeModal" />

    <nav class="fixed top-0 z-10 px-4 xl:px-16 py-4 w-full bg-white shadow-sm">
        <div class="flex items-center justify-between">
            <div class="block xl:hidden">
                <button type="button" @click="openModal"
                    class="relative flex items-center justify-center rounded-lg hover:bg-slate-100 w-9 h-9">
                    <Bars3Icon class="w-6 h-6 text-slate-800" />
                </button>
            </div>
            <div>
                <Link :href="route('home')">
                <Logo class="h-7 xl:h-8" />
                </Link>
            </div>

            <div class="hidden xl:block w-1/2">
                <div class="flex items-center border rounded-full px-4">
                    <MagnifyingGlassIcon class="w-5 h-5 text-slate-800" />
                    <input v-model="search" @keyup.enter="filter" type="text"
                        class="border-0 focus:ring-0 bg-transparent text-sm w-full" placeholder="Cari produk...">
                    <button v-if="search.length > 0" type="button" @click="removeFilter">
                        <XMarkIcon class="w-4 h-4 text-slate-800" />
                    </button>
                </div>
            </div>

            <div class="flex items-center xl:gap-3">
                <div>
                    <Link :href="route('carts.index')"
                        class="relative flex items-center justify-center rounded-lg hover:bg-slate-100 w-9 h-9">
                    <ShoppingCartIcon class="w-6 h-6 text-slate-800" />
                    <div v-if="$page.props.auth.user && $page.props.quantity > 0"
                        class="absolute top-0 right-0 ring-2 ring-white flex items-center justify-center w-3.5 h-3.5 bg-red-600 rounded-full text-white font-bold text-[9px]">
                        <div>{{ $page.props.quantity }}</div>
                    </div>
                    </Link>
                </div>
                <div v-if="$page.props.auth.user" class="hidden xl:block">
                    <Link :href="route('account')"
                        class="flex items-center justify-center rounded-xl hover:bg-neutral-100 w-10 h-10">
                    <UserIcon class="w-6 h-6" />
                    </Link>
                </div>
                <div v-else class="flex gap-2">
                    <div class="hidden xl:block">
                        <Link :href="route('login')"
                            class="border border-lime-600 text-lime-600 text-sm font-medium rounded-full px-5 py-2.5">
                        Masuk
                        </Link>
                    </div>
                    <div class="hidden xl:block">
                        <Link :href="route('login')"
                            class="bg-lime-600 text-white text-sm font-medium rounded-full px-5 py-2.5">
                        Daftar
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import SidebarMenu from '@/Components/Sidebar/Menu.vue';
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
        SidebarMenu,
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