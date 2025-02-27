<template>
    <MainLayout>
        <h1>Каталог товаров</h1>

        <h2>Группы товаров</h2>
        <Groups :groups="groups" :level="0" :activeGroups="activeGroups" @update-active-group="updateActiveGroup"/>


        <h2 class="mt-4">Товары</h2>
        <!-- Настройки отображения -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Выбор количества товаров -->
            <div>
                <label for="perPage" class="form-label me-2">Товаров на странице:</label>
                <select id="perPage" class="form-select w-auto d-inline-block" v-model="perPage" @change="fetchProducts()">
                    <option v-for="option in perPageOptions" :key="option" :value="option">{{ option }}</option>
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
                                <Link :href="route('product.show', product.id)" class="btn btn-primary">Подробнее</Link>
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

// Переключение между списком и сеткой
const viewMode = ref('grid');

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
