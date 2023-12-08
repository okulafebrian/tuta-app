<template>
    <Head title="Dashboard" />

    <Sidebar />

    <div class="w-[85%] ms-auto px-10 pt-6 pb-12">
        <!-- <div class="text-xl font-semibold mb-6">Dashboard</div> -->

        <div class="grid grid-cols-3">
            <div>
                Pesanan baru
            </div>
            <div>
                Siap dikirim
            </div>
            <div>
                Pesanan baru
            </div>
        </div>
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