<template>
    <div class="container mt-5">
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <ul class="list-group">
            <li
                v-for="group in groups"
                :key="group.id"
                class="list-group-item"
            >
                <p
                    @click="setActive(group)"
                    :class="{ 'active': group.active }">
                    {{ group.name }} ({{ group.products_quantity }})
                </p>

                <GroupItem :group="group" />
            </li>
        </ul>

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
import GroupItem from './GroupItem.vue';
const props = defineProps({
    groups: Array,
});

// Функция для обработки клика и установки active
const setActive = (group) => {
    group.active = !group.active; // Переключаем состояние
};
</script>

<style scoped>
.active {
    background-color: #d4edda;
}
</style>
