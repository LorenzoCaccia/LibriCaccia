<template>
  <div class="w-full min-h-screen max-w-screen-md mx-auto flex flex-col">
    <div class="flex flex-row p-5 items-end">
      <div class="text-4xl font-bold pr-5">
        {{ book.title }}
      </div>
      <div class="pr-5">{{ book.author }}</div>
    </div>

    <div class="flex">
        <div class="flex flex-col ">
            <img :src="book.cover" :alt="book.title" class="w-48" />
        </div>
      <div class="flex flex-col ml-12">
        <div>
            Rating: {{ book.rating }}/5
        </div>
        <div>
            ISBN: {{ book.isbn }}
        </div>
        </div>
    </div>

  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      book: null,
      genre: null,
    };
  },
  async mounted() {
    let bookId = this.$route.params.id;
    let responseBook = await axios.get("http://localhost:8000/api/book/detail/" + bookId);

    this.book = responseBook.data;

  },
  methods: {
    goBack(){
      this.$router.back();
    }
  },
};
</script>