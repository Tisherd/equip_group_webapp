<template>
    <div class="container mt-5">
        <h1>{{ group.name }}</h1>

        <h2>Подгруппы</h2>
        <ul class="list-group">
            <li v-for="subgroup in subgroups" :key="subgroup.id" class="list-group-item">
                <Link :href="route('group.show', subgroup.id)">
                {{ subgroup.name }}
                </Link>
            </li>
        </ul>

        <h2 class="mt-5">Товары</h2>

        <div class="mb-3">
            <label class="me-2">Сортировка:</label>
            <select v-model="sortBy" class="form-select w-auto d-inline-block" @change="applySorting">
                <option value="name">По названию</option>
                <option value="price">По цене</option>
            </select>

            <button class="btn btn-outline-primary ms-2" @click="toggleOrder">
                {{ order === 'asc' ? '⬆️' : '⬇️' }}
            </button>
        </div>

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
                <li class="page-item" :class="{ disabled: !products.prev_page_url }">
                    <Link class="page-link" :href="products.prev_page_url || '#'" preserve-scroll>Назад</Link>
                </li>
                <li class="page-item" :class="{ disabled: !products.next_page_url }">
                    <Link class="page-link" :href="products.next_page_url || '#'" preserve-scroll>Вперёд</Link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    group: Object,
    subgroups: Array,
    products: Object,
});

const sortBy = ref('name');
const order = ref('asc');

const applySorting = () => {
    router.get(route('group.show', props.group.id), { sort_by: sortBy.value, order: order.value }, { preserveState: true });
};

const toggleOrder = () => {
    order.value = order.value === 'asc' ? 'desc' : 'asc';
    applySorting();
};
</script>
