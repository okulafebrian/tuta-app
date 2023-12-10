<template>
    <div class="w-[15%] h-full fixed bg-white py-6">
        <div class="text-sm font-medium">
            <Link :href="route('dashboard')"
                class="relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80"
                :class="$page.component === 'Dashboard' ? 'text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600' : 'text-gray-400'">
            <HomeIcon class="w-5 h-5" />
            <div>Dashboard</div>
            </Link>

            <Link :href="route('orders.manage')"
                class="relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80"
                :class="$page.component.startsWith('Orders') ? 'text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600' : 'text-gray-400'">
            <ShoppingBagIcon class="w-5 h-5" />
            <div>Pesanan</div>

            </Link>

            <Link :href="route('products.index')"
                class="relative flex items-center gap-3 text-start w-full px-6 py-3 hover:bg-slate-100/80"
                :class="$page.component.startsWith('Products') || $page.component.startsWith('Collections') ? 'text-lime-600 after:top-2 after:bottom-2 after:left-0 after:border-2 after:absolute after:border-lime-600' : 'text-gray-400'">
            <ArchiveBoxIcon class="w-5 h-5" />
            <div>Produk</div>
            </Link>
        </div>
    </div>
</template>

<script>
import Logo from '@/Components/Icon/Logo.vue';
import { HomeIcon, ShoppingBagIcon, ArchiveBoxIcon, ArrowLeftOnRectangleIcon } from '@heroicons/vue/24/solid';

export default {
    components: {
        Logo,
        HomeIcon, ShoppingBagIcon, ArchiveBoxIcon, ArrowLeftOnRectangleIcon
    }
}
</script>

<style lang="scss" scoped></style>