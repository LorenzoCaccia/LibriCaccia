<template>
  <div class="px-12">
    <h1 class="text-center text-2xl mb-5 font-bold">Inserisci un nuovo genere letterario</h1>
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
                v-model="newGenre[field.code]"
              />
            </div>
            <div v-if="field.type == 'number'">
              <input
                :id="field.code"
                :placeholder="field.placeholder"
                class="flex-grow p-2 px-3 rounded focus:outline-none border w-full"
                type="number"
                v-model="newGenre[field.code]"
              />
            </div>
          </div>
          <div
            class="flex items-center px-3 text-red-600"
            v-if="field.required"
          >
            <span v-if="!newGenre[field.code]">
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
        @click="saveGenre()"
      >
        Inserisci Genere
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {

      newGenre: {
        name: "",
      },
      formFields: [
        {
          code: "name",
          label: "Genere",
          type: "text",
          placeholder:"Inserisci il titolo",
          required: true,
        },
      ]
    };
  },

  async mounted() {

  },
  methods: {
    async saveGenre() {
      let response;

      response = await axios.post("http://localhost:8000/api/genres/create", this.newGenre);

      console.log(response)

      this.$router.push("/list");
    }
  },
  computed: {
    isFormValid() {
      let formIsValid = true;

      this.formFields.forEach(field => {
        if (field.required) {
          formIsValid = formIsValid && !!this.newGenre[field.code];
        }
      });

      return formIsValid;
    }
  }
};
</script>
