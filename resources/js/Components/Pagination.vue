<template>
    <div class="flex gap-2">
        <Component :is="link.url ? 'Link' : 'span'" v-for="(link, index) in links" :href="link.url" :key="link.label"
            class="p-1 flex items-center justify-center text-sm font-semibold text-gray-400"
            :class="[{ 'cursor-not-allowed': !link.url }, { 'text-lime-600': link.active }]">

            <div v-if="index == 0" class="p-1">
                <ChevronLeftIcon class="w-4 h-4 stroke-2" />
            </div>
            <div v-else-if="index == links.length - 1" class="p-1">
                <ChevronRightIcon class="w-4 h-4 stroke-2" />
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