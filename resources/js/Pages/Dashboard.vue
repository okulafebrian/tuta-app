<template>
    <Head title="Dashboard" />

    <Sidebar />

    <div class="w-[85%] ms-auto px-10 pt-6 pb-12">
        <div class="text-lg font-semibold">TUTA OFFICIAL SHOP</div>
        <div class="text-sm">Admin Panel</div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Sidebar from '@/Components/Sidebar/Admin.vue'

export default {
    components: {
        Sidebar
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>