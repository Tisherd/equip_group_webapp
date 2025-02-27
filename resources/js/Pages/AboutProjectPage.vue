<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import readme from '@/../../README.md?raw';
import { ref } from 'vue';
import { marked } from 'marked';

const markdownContent = ref('');
markdownContent.value = marked(readme);
</script>

<template>
    <MainLayout>
        <div class="prose prose-lg max-w-none p-6 bg-white shadow-md rounded-md">
            <div v-html="markdownContent"></div>
        </div>
    </MainLayout>
</template>
