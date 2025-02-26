<template>
    <div class="container mt-5">
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <Groups :groups="groups" :level="0" :activeGroups="activeGroups" @update-active-group="updateActiveGroup"/>

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
import Groups from './Groups.vue';
import { reactive, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    groups: Array,
    initialProducts: Object,  // Данные продуктов, передаваемые через props
});

let products = ref(props.initialProducts);  // Локальная реактивная переменная

const activeGroups = reactive({});

const updateActiveGroup = async (group) => {
    // Запрос к API
    try {
        const response = await axios.get('/api/products', {
            params: { group_ids: group.full_group_ids }
        });
        products.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки товаров:', error);
    }
};
</script>
