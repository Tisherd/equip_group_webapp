<template>
    <div class="bg-light text-dark d-flex flex-column min-vh-100 overflow-hidden">
        <Header />
        <main class="container py-4 flex-grow-1">
            <slot />
        </main>
    </div>
</template>

<script setup>
import Header from "@/Components/Header.vue";
</script>
