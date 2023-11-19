<template>
    <Head title="Biodata Diri" />

    <div class="xl:px-20 pt-6 xl:pt-10 flex flex-col xl:flex-row xl:gap-24">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:block text-2xl font-semibold mb-6">Biodata Diri</div>

            <div class="flex justify-between items-center border rounded-2xl p-4 xl:p-6 mb-4">
                <div>
                    <div class="font-semibold mb-1">Nama Lengkap</div>
                    <div>{{ auth.user.first_name }} {{ auth.user.last_name }}</div>
                </div>
                <button type="button" class="text-sm font-semibold text-lime-600 hover:text-lime-700">
                    Edit
                </button>
            </div>

            <div class="flex justify-between items-center border rounded-2xl p-4 xl:p-6">
                <div>
                    <div class="font-semibold mb-1">Nomor HP</div>
                    <div>{{ auth.user.phone }}</div>
                </div>
                <button type="button" class="text-sm font-semibold text-lime-600 hover:text-lime-700">
                    Edit
                </button>
            </div>

            <button type="button" @click="test">Test Tariff Checking</button>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import Sidebar from '@/Components/Sidebar/Account.vue';

export default {
    components: {
        Sidebar
    },
    props: {
        auth: Object
    },
    methods: {
        test() {
            this.$inertia.get('orders.test');
        }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>