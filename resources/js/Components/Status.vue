<template>
    <div v-if="status === 1" class="flex items-center text-xs font-semibold bg-amber-100 text-amber-600 rounded-md px-2">
        <div>Pending</div>
    </div>
    <div v-else-if="status === 3"
        class="flex items-center text-xs font-semibold bg-amber-200 text-amber-600 rounded-md px-2">
        <div>Siap Dikirim</div>
    </div>
    <div v-else-if="status === 4"
        class="flex items-center text-xs font-semibold bg-amber-100 text-amber-600 rounded-md px-2">
        <div>Dalam Pengiriman</div>
    </div>
    <div v-else-if="status === 5" class="flex items-center text-xs font-semibold bg-lime-100 text-lime-600 rounded-md px-2">
        <div>Pesanan Selesai</div>
    </div>
    <div v-else-if="status === 2" class="flex items-center text-xs font-semibold bg-gray-200 text-gray-600 rounded-md px-2">
        <div>Dibatalkan</div>
    </div>
</template>

<script>
export default {
    props: {
        status: Number
    }
}
</script>

<style lang="scss" scoped></style>