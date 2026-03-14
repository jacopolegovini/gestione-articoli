<script setup>
import { ref, onMounted } from 'vue';

const authors = ref([]);

onMounted(() => {
    const el = document.getElementById('app-authors');
    if (el && el.dataset.authors) {
        authors.value = JSON.parse(el.dataset.authors);
    }
});
</script>

<template>
    <div class="authors-container">
        <p v-if="authors.length === 0">Nessun autore trovato nel database.</p>

        <ul class="authors-grid">
            <li v-for="author in authors" :key="author.id" class="list__card">
                <address class="author-name">
                    <strong>{{ author.name }}</strong>
                </address>
                <span class="article-count">
                    {{ author.articlesCount || 0 }} articoli pubblicati
                </span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.authors-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    list-style-type: none;
    padding: 0;
}

.list__card {
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    min-width: 200px;
    flex: 1 1 calc(33.333% - 20px);
    /* Tre card per riga */
}

.author-name {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: #2c3e50;
}

.article-count {
    font-size: 0.9rem;
    color: #666;
}
</style>
