<template>
    <MainLayout>
        <h1>{{ product.name }}</h1>
        <p>Цена: {{ product.price?.price }} ₽</p>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" v-for="crumb in breadcrumbs" :key="crumb.id">
                </li>
            </ol>
        </nav>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
});
</script>
