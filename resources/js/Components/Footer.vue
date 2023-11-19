<template>
    <div
        class="flex flex-col xl:flex-row items-center justify-between gap-6 text-sm bg-lime-600 text-white px-4 py-6 xl:px-20">
        <div class="flex justify-between xl:justify-normal xl:gap-8 w-full xl:w-auto">
            <!-- <div>
                <Link>Pertanyaan Umum</Link>
            </div> -->
            <div>
                <Link :href="route('about')">Tentang Kami</Link>
            </div>
            <!-- <div>
                <Link>Hubungi Kami</Link>
            </div> -->
        </div>
        <div>PT TUTA MANDIRI INDONESIA @ 2023 </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<style lang="scss" scoped></style>