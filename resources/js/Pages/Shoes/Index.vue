<template>
    <AuthenticatedLayout>
        <div class="py-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Atur Produk</h2>
                <Link :href="route('shoes.create')"
                    class="px-4 py-2 rounded-lg bg-lime-500 hover:bg-lime-600 text-sm font-medium text-white">
                Tambah Produk
                </Link>
            </div>

            <div class="bg-white p-6 rounded-lg">
                <table class="w-full">
                    <thead class="border-b text-xs">
                        <tr class="text-left">
                            <th class="py-3 pl-4">DETAIL PRODUK</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr v-for="shoe in shoes" class="border-b">
                            <td class="py-2 pl-4">
                                <p class="font-medium">{{ shoe.name }}</p>
                                <p class="text-xs">{{ shoe.category.name }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout, Link
    },
    props: {
        shoes: Object
    }
}
</script>

<style lang="scss" scoped></style>