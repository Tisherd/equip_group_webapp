<template>
    <ul class="list-group">
        <li
            v-for="(group) in groups"
            :key="group.id"
            class="list-group-item"
        >
            <p
                @click="setGroup(group)"
                :class="{ 'active': group.active }">
                {{ group.name }} ({{ group.products_quantity }})
            </p>

            <Groups v-if="group.active" :groups="group.children"/>
        </li>
    </ul>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    groups: Array,
});

const setGroup = (group) => {
    router.visit(route('catalog', { activeGroupId: group.id }), {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<style scoped>
.active {
    color: blue;
}
</style>
