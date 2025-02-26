<template>
    <ul v-if="group.active" class="list-group">
        <li
            v-for="group_child in group.children"
            :key="group_child.id"
            class="list-group-item"
        >
            <p
                @click="setActive(group_child)"
                :class="{ 'active': group_child.active }">
                {{ group_child.name }} ({{ group_child.products_quantity }})
            </p>

            <GroupItem :group="group_child" />
        </li>
    </ul>
</template>

<script setup>


defineProps({
    group: {
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
