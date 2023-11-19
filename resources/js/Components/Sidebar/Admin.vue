<template>
    <div class="w-[15%] shadow h-ful">
        <div class="m-6 mb-8">
            <Link :href="route('dashboard')">
            <Logo class="h-8" />
            </Link>
        </div>
        <div class="text-sm font-medium space-y-4">
            <Link :href="route('dashboard')" class="relative flex items-center gap-3 text-start w-full px-6 py-1 rounded-md"
                :class="$page.component === 'Dashboard' ? 'text-lime-600 after:center-0 after:left-0 after:border-2 after:absolute after:h-full after:border-lime-600' : 'text-gray-400'">
            <HomeIcon class="w-5 h-5" />
            <div>Dashboard</div>
            </Link>

            <Link :href="route('orders.manage')"
                class="relative flex items-center gap-3 text-start w-full px-6 py-1 rounded-md"
                :class="$page.component.startsWith('Orders') ? 'text-lime-600 after:center-0 after:left-0 after:border-2 after:absolute after:h-full after:border-lime-600' : 'text-gray-400'">
            <ShoppingBagIcon class="w-5 h-5" />
            <div>Pesanan</div>
            </Link>

            <Link :href="route('shoes.index')"
                class="relative flex items-center gap-3 text-start w-full px-6 py-1 rounded-md"
                :class="$page.component.startsWith('Shoes') ? 'text-lime-600 after:center-0 after:left-0 after:border-2 after:absolute after:h-full after:border-lime-600' : 'text-gray-400'">
            <ArchiveBoxIcon class="w-5 h-5" />
            <div>Produk</div>
            </Link>
        </div>
    </div>
</template>

<script>
import Logo from '@/Components/Icon/Logo.vue';
import { HomeIcon, ShoppingBagIcon, ArchiveBoxIcon } from '@heroicons/vue/24/solid';

export default {
    components: {
        Logo,
        HomeIcon, ShoppingBagIcon, ArchiveBoxIcon
    }
}
</script>

<style lang="scss" scoped></style>