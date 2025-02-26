<template>
    <div class="container mt-5">
        <h1>{{ product.name }}</h1>
        <p>Цена: {{ product.price?.price }} ₽</p>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" v-for="crumb in breadcrumbs" :key="crumb.id">
                    <Link :href="route('group.show', crumb.id)">{{ crumb.name }}</Link>
                </li>
            </ol>
        </nav>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    product: Object,
    breadcrumbs: Array,
});
</script>
