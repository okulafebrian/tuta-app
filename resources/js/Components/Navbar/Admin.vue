<template>
    <nav class="fixed top-0 z-10 px-20 py-4 shadow-sm w-full bg-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-16">
                <Link :href="route('dashboard')">
                <Logo class="h-8" />
                </Link>
                <div class="space-x-6 text-sm font-medium">
                    <Link :href="route('dashboard')">Dashboard</Link>
                    <Link :href="route('orders.manage')">Pesanan</Link>
                    <Link :href="route('shoes.index')">Produk</Link>
                </div>
            </div>

            <Link :href="route('admin.logout')" method="post" as="button" class="text-sm font-medium">
            Logout
            </Link>
        </div>
    </nav>
</template>

<script>


export default {
}
</script>

<style lang="scss" scoped></style>