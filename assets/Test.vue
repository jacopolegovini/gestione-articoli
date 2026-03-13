<template>
    <div class="mt-4">
        <h3>Lista Articoli (Caricata con Vue)</h3>
        <ul class="list-group">
            <li v-for="article in articles" :key="article.id" class="list-group-item">
                {{ article.title }} - <span class="text-muted">{{ article.author }}</span>
            </li>
        </ul>
        <div v-if="articles.length === 0" class="alert alert-info">
            Nessun articolo trovato.
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const articles = ref([]);

onMounted(() => {
    // Recuperiamo i dati dall'attributo "data-articles" del div HTML
    const el = document.getElementById('app-test');
    if (el && el.dataset.articles) {
        articles.value = JSON.parse(el.dataset.articles);
    }
});
</script>
