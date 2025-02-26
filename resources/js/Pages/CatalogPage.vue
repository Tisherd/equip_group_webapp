<template>
    <div class="container mt-5">
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <Groups :groups="groups" :level="0" :activeGroups="activeGroups" @update-active-group="updateActiveGroup"/>

        <!-- Выбор количества товаров на странице -->
        <div class="mb-3">
            <label for="perPage" class="form-label">Товаров на странице:</label>
            <select id="perPage" class="form-select w-auto d-inline-block" v-model="perPage" @change="fetchProducts()">
                <option v-for="option in perPageOptions" :key="option" :value="option">{{ option }}</option>
            </select>
        </div>

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

        <!-- Пагинация -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li v-for="(link, k) in products.links" :key="k" class="page-item" :class="{ active: link.active, disabled: !link.url }">
                    <a v-if="link.url" class="page-link" href="#" @click.prevent="fetchProducts(link.url)">{{ link.label }}</a>
                    <span v-else class="page-link" v-html="link.label"></span>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import Groups from './Groups.vue';
import { reactive, ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    groups: Array,
});

const products = ref({ data: [], links: [] });
const activeGroup = ref(null);
const activeGroups = reactive({});

// Количество товаров на странице
const perPage = ref(6);
const perPageOptions = [6, 12, 18];

const fetchProducts = async (url = '/api/products') => {
    try {
        const response = await axios.get(url, {
            params: {
                group_ids: activeGroup.value,
                per_page: perPage.value
            }
        });
        products.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки товаров:', error);
    }
};

const updateActiveGroup = async (group) => {
    activeGroup.value = group.full_group_ids;
    fetchProducts();
};

onMounted(() => {
    fetchProducts();
});
</script>
