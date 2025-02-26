<template>
    <div class="container mt-5">
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <Groups :groups="groups" />

        <h2 class="mt-5">Товары</h2>
        <!-- <div class="row">
            <div v-for="product in products.data" :key="product.id" class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.price?.price }} ₽</p>
                        <Link :href="route('product.show', product.id)" class="btn btn-primary">Подробнее</Link>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script setup>
import Groups from './Groups.vue';
const props = defineProps({
    groups: Array,
});
</script>
