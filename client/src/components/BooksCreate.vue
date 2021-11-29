<template>
  <div class="px-12">
    <h1 class="text-center text-2xl mb-5 font-bold">Inserisci un nuovo libro</h1>
    <div class="flex">
      <div class="flex flex-col flex-grow">
        <div
          class="grid grid-cols-3 mb-3 gap-5 "
          v-for="(field, index) in formFields"
          :key="index"
        >
          <label
            :for="field.code"
            class="flex items-center font-bold text-xl"
          >
            {{ field.label }}
          </label>
          <div class="flex-grow text-black">
            <div v-if="field.type == 'text'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none w-full border"
                type="text"
                v-model="newBook[field.code]"
              />
            </div>

            <div v-if="field.type == 'selectGenre'">
              <select
                class="flex-grow p-2 px-3 rounded  focus:outline-none w-full border"
                v-model="newBook.genre_id"
              >
                <option
                  v-for="genre in genres"
                  :key="genre.id"
                  :value="genre.id"
                >
                  {{ genre.name }}
                </option>
              </select>
            </div>
            <div v-if="field.type == 'number'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none border w-full"
                type="number"
                v-model="newBook[field.code]"
              />
            </div>
          </div>
          <div
            class="flex items-center px-3 text-red-600"
            v-if="field.required"
          >
            <span v-if="!newBook[field.code]">
              Questo campo è obbligatorio
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 text-xl">
      <button
        :disabled="!isFormValid"
        :class="{
          'bg-green-500 cursor-pointer': isFormValid,
          'bg-red-600 cursor-not-allowed': !isFormValid
        }"
        class="px-3 py-1 rounded"
        @click="saveBook()"
      >
        Inserisci Libro
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      isEdit: false,
      genres : [],
      newBook: {
        title: "",
        author: "",
        isbn: "",
        rating: 1,
        cover: "",
        genre_id: 0,
      },
      formFields: [
        {
          code: "title",
          label: "Titolo",
          type: "text",
          placeholder:"Inserisci il titolo",
          required: true,
        },
        {
          code: "author",
          label: "Autore",
          type: "text",
          placeholder:"Inserisci l'autore",
          required: true,
        },
        {
          code: "isbn",
          label: "Codice ISBN",
          type: "text",
          placeholder:"Inserisci il codice isbn",
          required: true,
        },
        {
          code: "rating",
          label: "Rating (da 1 a 5)",
          type: "number",
          placeholder:"Inserisci il tuo personale rating del libro",
          required: true,
        },
        {
          code: "cover",
          label: "Copertina",
          type: "text",
          placeholder:"Inserisci il link per l'immagine della copertina",
          required: true,
        },
        {
          code: "genre_id",
          label: "Genere",
          type: "selectGenre",
          optionField: "id",
          optionLabel: "name",
          placeholder:"Inserisci il genere",
          required: true,
        },

      ]
    };
  },

  async mounted() {

      let responseGenres = await axios.get("http://localhost:8000/api/genres");
      this.genres = responseGenres.data;

      console.log(this.newBook);
    
  },
  methods: {
    async saveBook() {
      let response;

      response = await axios.post("http://localhost:8000/api/books/create", this.newBook);

      console.log(response.data);

      this.$router.push("/list");
    }
  },
  computed: {
    isFormValid() {
      let formIsValid = true;

      this.formFields.forEach(field => {
        if (field.required) {
          formIsValid = formIsValid && !!this.newBook[field.code];
        }
      });

      return formIsValid;
    }
  }
};
</script>
