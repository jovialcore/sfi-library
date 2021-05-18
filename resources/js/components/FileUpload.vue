<template>
  <div class="container bg-dark p-5 mt-5">
    <div class="form-group">
      <label class="text-white"
        >Add a category <span style="color: red">ONLY IF</span> there are no
        entries from the <span style="color: green">Category</span> section
        below!</label
      >
      <div
        v-bind:class="{
          'alert alert-dismissible alert-success show ': isActive,
          'alert alert-dismissible alert-danger show': hasError,
        }"
        class=""
        role="alert"
      >
        {{ success }} {{ errorMsg }}
        <div v-for="(errorArray, idx) in errors" :key="idx">
          <div v-for="(allErrors, idx) in errorArray" :key="idx">
            {{ allErrors }}
          </div>
        </div>
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
          @click="OnClose"
        >
          <span aria-hidden="true" v-show="notifDisplay">&times;</span>
        </button>
      </div>

      <div class="mb-3">
        <input
          type="text"
          v-model="category"
          class="w-50 form-control"
          placeholder="Add a category..."
        />
        <button class="btn btn-success mt-3" @click="addCatbtn">Add</button>
      </div>

      <form>
        <label class="text-white">Select a Category: </label>
        <div>
          <select
            class="custom-select w-50 mb-4"
            v-model="cat.name"
            value="dropdown"
            placeholder="add a category"
          >
            <option v-for="(allCats, idx) in computedCats" :key="idx.id">
              {{ allCats.name }}
            </option>
          </select>
        </div>

        <label class="text-white">Select File: </label>
        <input
          type="file"
          multiple
          @change="uponUpload"
          id="upload-file"
          class="w-50 form-control"
          placeholder="Select file..."
          ref="file"
        />
      </form>
    </div>
    <button class="btn btn-success" @click="submitFile">Submit</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifDisplay: false,
      attachments: [],
      form: new FormData(),
      isActive: null,
      hasError: null,
      success: "",
      errors: "",
      errorMsg: "",
      category: "",
      cat: {
        name: "",
      },
    };
  },
  props: ["categories"],
  computed: {
    message: function () {
      return "hello wolrd";
    },
    computedCats: function () {
      return this.categories;
    },
  },
  methods: {
    OnClose() {
      this.hasError = false;
      this.isActive = false;
      this.errors = "";
      this.errorMsg = "";
      this.success = "";
      this.notifDisplay = false;
      this.$refs.file.value = null;
      this.attachments = [];
    },
    addCatbtn() {
      if (this.category == "") return;
      axios
        .post("/addcategory", {
          name: this.category,
        })
        .then((response) => {
          if ((response.status = 201)) {
            this.$emit("categoriesUpdated");
            this.category = "";
            this.errors = "";
            this.errorMsg = "";
            this.notifDisplay = true;
            this.success = response.data.success;
            this.isActive = true;
            this.hasError = false;
          }
        })
        .catch((error) => {
          this.notifDisplay = true;
          this.category = "";
          this.hasError = true;
          this.isActive = false;
          this.success = "";
          this.errors = error.response.data.errors;
          this.errorMsg = error.response.data.message;
        });
    },
    uponUpload(e) {
      //i should have use computed properties here...so everything happens by default;
      this.success = "";
      this.errors = "";
      this.errorMsg = "";
      this.isActive = false;
      this.hasError = false;
      let selectedFiles = e.target.files;
      //if there are no files
      if (!selectedFiles.length) {
        return false;
      }
      //lets loop through all the files that will be selected
      for (let i = 0; i < selectedFiles.length; i++) {
        //so here we are going to push eevryhting thh attachment array vaiable
        this.attachments.push(selectedFiles[i]);
      }
    },
    submitFile() {
      //append all the file to the form data
      for (let i = 0; i < this.attachments.length; i++) {
        this.form.append('pic[]', this.attachments[i]);
      }
      //without the JSON.stringify() you will have an object.object 'error'
      this.form.append("cats", JSON.stringify(this.cat.name));
      //lets set the file to multipart/form data for content type
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      axios
        .post("/submit", this.form, config)
        .then((response) => {
          //success
          if ((response.status = 201)) {
            this.isActive = true;
            this.notifDisplay = true;
            this.success = response.data.success;
            this.$refs.file.value = null;
          }
        })
        .catch((error) => {

            this.hasError = true;
            this.notifDisplay = true;
            this.errors = error.response.data.errors;
            this.$refs.file.value = null

        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
