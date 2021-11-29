<template>
  <div class="flex max-w-screen py-2 bg-blue-300 px-14">
    <div class="flex text-white">
      <button
      v-for="link in navLinks"
      :key="link.code"
      :class="{
        'text-decoration: underline p-2': link.code == currentRouteName,
      }"
      @click="goToLink(link)"
      class="mr-8 cursor-pointer px-3 my-4 rounded-full bg-blue-600"
    >
      {{ link.label }}
    </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      navLinks: [
        {
          label: "Home",
          code: "books_list"
        },
        {
          label: "Inserisci Libro",
          code: "books_create"
        },

      ]
    };
  },
  computed: {
    currentRouteName() {
      return this.$route.matched[0].name;
    }
  },
  methods: {
    goToLink(link) {
      this.$router.push({
        name: link.code
      });
    }
  }
};
</script>
