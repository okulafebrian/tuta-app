<template>
    <nav class="sticky top-0 z-10 px-6 py-4 shadow-sm w-full bg-white">
        <div class="flex items-center justify-between">
            <div>
                <Link :href="route('dashboard')">
                <Logo class="h-6" />
                </Link>
            </div>

            <Link :href="route('admin.logout')" method="post" as="button" class="text-sm font-medium">
            Keluar
            </Link>
        </div>
    </nav>
</template>

<script>


export default {
}
</script>

<style lang="scss" scoped></style>