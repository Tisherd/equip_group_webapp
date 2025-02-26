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

            <Groups v-if="activeGroups[level]?.id === group.id" :groups="group.children" :level="nextLevel" :activeGroups="activeGroups"/>
        </li>
    </ul>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    groups: Array,
    level: Number,
    activeGroups: Object,
});

const nextLevel = computed(() => props.level + 1);

const setActive = (group, level) => {
    if (props.activeGroups[level]?.id === group.id) {
        // Если уже активна, сбрасываем
        delete props.activeGroups[level];
    } else {
        // Убираем активность на этом уровне и ниже
        Object.keys(props.activeGroups).forEach(lvl => {
            if (lvl >= level) {
                delete props.activeGroups[lvl];
            }
        });

        // Устанавливаем новую активную группу
        props.activeGroups[level] = group;
    }
};
</script>

<style scoped>
.active {
    color: blue;
}
</style>
