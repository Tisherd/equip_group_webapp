<template>
    <MainLayout>
        <!-- Хлебные крошки -->
        <nav>
            <span v-for="(group, index) in groups" :key="group.id">
                <span v-if="index !== 0"> → </span>
                <a @click.prevent="goToGroup(group.id)" href="#" class="breadcrumb-link">
                    {{ group.name }}
                </a>
            </span>
        </nav>

        <!-- Название товара -->
        <h1>{{ product.name }}</h1>
        <p>Цена: {{ product.price?.price }} ₽</p>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    groups: Array, // Весь массив групп
});

// Переход по хлебным крошкам
const goToGroup = (groupId) => {
    router.visit(route('catalog', { activeGroupId: groupId }));
};
</script>

<style scoped>
.breadcrumb-link {
    color: blue;
    cursor: pointer;
    text-decoration: underline;
}
.breadcrumb-link:hover {
    text-decoration: none;
}
</style>
