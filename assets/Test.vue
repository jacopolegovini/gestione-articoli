<template>
    <h2>Lista Articoli</h2>
    <ul class="list">
        <li v-for="article in articles" :key="article.id" class="list__card">
            <address>{{ article.author }}</address>
            <cite>"{{ article.title }}"</cite>
        </li>
    </ul>
    <div v-if="articles.length === 0" class="alert alert-info">
        Nessun articolo trovato.
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const articles = ref([]);

onMounted(() => {
    const el = document.getElementById('app-test');
    if (el && el.dataset.articles) {
        articles.value = JSON.parse(el.dataset.articles);
    }
});
</script>
