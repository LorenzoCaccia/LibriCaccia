<template>
    <div class="w-full px-12 grid grid-cols-5">
        <div v-for="(book, index) in books" :key="index" class="flex flex-col items-center p-2">
            <img @click="goToBookDetail(book)" :src="book.cover" :alt="book.title" class="flex">
            <div class="flex">
                {{ book.title}}
            </div>
            <div class="flex">
                {{ book.author}}
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";


export default {
    name: "BooksList",
    data() {
        return{
            books: [],
            isLoading: true
        }
    },
    async mounted() {
        this.isLoading = true;
        let response = await axios.get("http://localhost:8000/api/books");
        this.books = response.data;
        this.isLoading = false;
    },
    methods: {
        goToBookDetail(book) {
        this.$router.push("/detail/" + book.id);
        },
    }
}
</script>