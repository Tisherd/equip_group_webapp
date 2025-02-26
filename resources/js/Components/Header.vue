<template>
    <header class="bg-secondary text-white p-3 d-flex justify-content-between align-items-center">
        <ul class="nav">
            <li class="nav-item">
                <Link :href="route('about_project')" class="nav-link text-white">О проекте</Link>
            </li>
            <li class="nav-item">
                <Link :href="route('catalog')" class="nav-link text-white">Каталог</Link>
            </li>
        </ul>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.nav-link {
    padding-left: 1.25rem; /* Пример отступа, можно настроить */
    padding-right: 1.25rem; /* Пример отступа, можно настроить */
}
</style>
