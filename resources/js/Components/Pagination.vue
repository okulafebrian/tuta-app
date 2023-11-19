<template>
    <div class="flex items-center bg-white shadow-sm w-fit rounded-md">
        <Component :is="link.url ? 'Link' : 'span'" v-for="(link, index) in links" :href="link.url" :key="link.label"
            class="w-4 h-8 mx-2 flex items-center justify-center text-sm font-semibold"
            :class="[link.url ? 'text-gray-600' : 'text-gray-300', { 'text-lime-600 border-b-2 border-lime-600': link.active }]">

            <div v-if="index == 0" class="p-3">
                <ChevronLeftIcon class="w-3 h-3 stroke-[3px]" />
            </div>
            <div v-else-if="index == links.length - 1" class="p-3">
                <ChevronRightIcon class="w-3 h-3 stroke-[3px]" />
            </div>
            <div v-else>{{ link.label }}</div>

        </Component>
    </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';

export default {
    components: {
        ChevronLeftIcon, ChevronRightIcon
    },
    props: {
        links: Array
    }
}
</script>

<style lang="scss" scoped></style>