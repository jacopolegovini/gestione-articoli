<script setup>
import { ref, onMounted } from 'vue';

const authors = ref([]);

onMounted(() => {
    const el = document.getElementById('app-authors');
    if (el && el.dataset.authors) {
        authors.value = JSON.parse(el.dataset.authors);
        console.log(authors.value)
    }
});
</script>

<template>
    <div class="authors-container">
        <p v-if="authors.length === 0">Nessun autore trovato nel database.</p>

        <ul class="authors-grid">
            <li v-for="author in authors" :key="author.id" class="list__card">
                <address class="author-name">
                    <strong>{{ author.name }}</strong> - <span>{{ author.email }}</span>
                </address>
                <span class="article-count">
                    {{ author.articlesCount || 0 }} articoli pubblicati
                </span>
            </li>
        </ul>
    </div>
</template>

<style scoped></style>
