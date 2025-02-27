<template>
    <MainLayout>
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <Groups :groups="groups"/>

        <h2 class="mt-4">Товары</h2>
        <!-- Настройки отображения -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <!-- Выбор количества товаров -->
                <label for="perPage" class="form-label me-2">Товаров на странице:</label>
                <select id="perPage" class="form-select w-auto d-inline-block me-3" v-model="perPage" @change="fetchProducts()">
                    <option v-for="option in perPageOptions" :key="option" :value="option">{{ option }}</option>
                </select>

                <!-- Сортировка -->
                <label for="sortBy" class="form-label me-2">Сортировать по:</label>
                <select id="sortBy" class="form-select w-auto d-inline-block" v-model="sortBy" @change="fetchProducts()">
                    <option value="price_asc">Цена (по возрастанию)</option>
                    <option value="price_desc">Цена (по убыванию)</option>
                    <option value="name_asc">Название (А-Я)</option>
                    <option value="name_desc">Название (Я-А)</option>
                </select>
            </div>

            <!-- Переключение вида -->
            <div class="btn-group">
                <button class="btn btn-outline-primary" :class="{ active: viewMode === 'grid' }" @click="viewMode = 'grid'">
                    &#x1F5C3; Сетка
                </button>
                <button class="btn btn-outline-primary" :class="{ active: viewMode === 'list' }" @click="viewMode = 'list'">
                    &#x2630; Список
                </button>
            </div>
        </div>

        <!-- Контейнер товаров -->
        <div class="row">
            <div v-for="product in products.data" :key="product.id" :class="viewMode === 'grid' ? 'col-md-4' : 'col-12'">
                <div class="card mb-3">
                    <div class="row g-0" :class="{ 'flex-row': viewMode === 'grid', 'flex-column': viewMode === 'list' }">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ product.name }}</h5>
                                <p class="card-text">{{ product.price?.price }} ₽</p>
                                <Link :href="route('products.show', product.id)" class="btn btn-primary">Подробнее</Link>
                            </div>
                        </div>
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
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Groups from '@/Components/Catalog/Groups.vue';
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    groups: Array,
    activeGroupId: Number,
});

const activeGroupId = ref(props.activeGroupId);
const products = ref({ data: [], links: [] });

// Количество товаров на странице
const perPage = ref(6);
const perPageOptions = [6, 12, 18];

// Переключение между списком и сеткой
const viewMode = ref('grid');

// Сортировка
const sortBy = ref('price_asc'); // Значение по умолчанию

const fetchProducts = async (url = '/api/products') => {
    try {
        const response = await axios.get(url, {
            params: {
                active_group: activeGroupId.value,
                per_page: perPage.value,
                sort_by: sortBy.value
            }
        });
        products.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки товаров:', error);
    }
};

onMounted(() => {
    fetchProducts();
});
</script>
