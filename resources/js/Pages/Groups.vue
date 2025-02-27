<template>
    <ul class="list-group">
        <li
            v-for="(group) in groups"
            :key="group.id"
            class="list-group-item"
        >
            <p
                @click="setActive(group, level)"
                :class="{ 'active': activeGroups[level]?.id === group.id }">
                {{ group.name }} ({{ group.products_quantity }})
            </p>

            <!-- <Groups v-if="activeGroups[level]?.id === group.id" :groups="group.children" :level="nextLevel" :activeGroups="activeGroups" @update-active-group="$emit('update-active-group', $event)"/> -->
            <Groups v-if="group.active" :groups="group.children" :level="nextLevel" :activeGroups="activeGroups" @update-active-group="$emit('update-active-group', $event)"/>
        </li>
    </ul>
</template>

<script setup>
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    groups: Array,
    level: Number,
    activeGroups: Object,
});

const nextLevel = computed(() => props.level + 1);

const emit = defineEmits(['update-active-group']);

const setActive = (group, level) => {
    router.visit(route('catalog', { activeGroupId: group.id }), {
            // preserveState: true, // Сохраняем состояние страницы
            // preserveScroll: true, // Сохраняем прокрутку
            // only: ['products'], // Обновляем только товары (если используется Inertia)
        });

    // if (props.activeGroups[level]?.id === group.id) {
    //     // Если уже активна, сбрасываем
    //     delete props.activeGroups[level];
    // } else {
    //     // Убираем активность на этом уровне и ниже
    //     Object.keys(props.activeGroups).forEach(lvl => {
    //         if (lvl >= level) {
    //             delete props.activeGroups[lvl];
    //         }
    //     });

    //     // Устанавливаем новую активную группу
    //     props.activeGroups[level] = group;

    //     emit('update-active-group', group);
    // }
};
</script>

<style scoped>
.active {
    color: blue;
}
</style>
