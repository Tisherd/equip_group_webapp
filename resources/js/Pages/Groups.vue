<template>
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

            <div v-if="group.active">
                <Groups :groups="group.children" />
            </div>
        </li>
    </ul>
</template>

<script setup>


defineProps({
    groups: {
        type: Object,
        required: true
    }
});

const setActive = (group) => {
    group.active = !group.active; // Переключаем состояние
};
</script>

<style scoped>
.active {
    color: blue;
}
</style>
