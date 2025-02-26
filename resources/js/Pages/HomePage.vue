<template>
    <div class="container mt-5">
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <ul class="list-group">
            <li v-for="group in groups" :key="group.id" class="list-group-item">
                <Link :href="route('group.show', group.id)">
                {{ group.name }} ({{ group.total_products }} товаров)
                </Link>
            </li>
        </ul>

        <h2 class="mt-5">Товары</h2>
        <div class="row">
            <div v-for="product in products.data" :key="product.id" class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.price?.price }} ₽</p>
                        <Link :href="route('product.show', product.id)" class="btn btn-primary">Подробнее</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    groups: Array,
    products: Object,
});
</script>
