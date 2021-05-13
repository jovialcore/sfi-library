<template>
  <div class="container bg-dark p-5 mt-5">
    <div class="form-group">
      <div
        v-bind:class="{
          'alert alert-dismissible fade in alert-success': isActive,
          'alert alert-dismissible alert-danger': hasError,
        }"
        class="ex-ccss"
      >
        {{ success }}
        <div v-for="errorArray in errors" :key="errorArray">
          <a href="#" class="close" data-dismiss="alert" aria-label="close"
            >&times;</a
          >
          <div v-for="allErrors in errorArray" :key="allErrors">
            {{ allErrors }}
          </div>
        </div>
      </div>

      <div class="mb-3">
        <input
          type="text"
          name="text"
          v-model="category"
          class="w-50 form-control"
          placeholder="Add a category..."
          @change="Ontype"
        />
        <button class="btn btn-success mt-3" @click="addCatbtn">Add</button>
      </div>

      <form>
        <label class="text-white"
          >Add a category <span style="color: red">ONLY IF</span> there are no
          entries from the <span style="color: green">Category</span> section
          below!</label
        >

        <label class="text-white">Select a Category: </label>
        <div>
          <select
            class="custom-select w-50 mb-4"
            v-model="cat.name"
            value="dropdown"
            placeholder="add a category"
          >
            <option v-for="allCats in categories" :key="allCats">
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
      attachments: [],
      form: new FormData(),
      isActive: null,
      hasError: null,
      success: "",
      errors: null,
      category: "",
      cat: {
        name: "",
      },
    };
  },

  props: ["categories"],

  methods: {
    Ontype() {
      this.hasError = null;
    },
    addCatbtn() {
      if (this.category == "") return;

      axios
        .post("/addcategory", {
          name: this.category,
        })
        .then((response) => {
          if ((response.status = 201)) {
            this.category = "";
            this.isActive = true;
            this.hasError = false;
            location.reload();
            this.success = response.data.success;
          }
        })
        .catch((error) => {
          this.hasError = true;
          this.category = "";
          this.errors =
            error.response.data.errors || error.response.data.message;
        });
    },
    uponUpload(e) {
      //i should have use computed properties here...so everything happens by default;
      this.success = "";
      this.errors = "";
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
        this.form.append("pics[]", this.attachments[i]);
      }

      //without the JSON.stringify() you will have an object.object 'error'
      this.form.append("cats", JSON.stringify(this.cat.name));

      //lets set the file to multipart/form data for content type
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };

      // lets get the first request
      //   const fileUploadRequest = axios.post('/submit', this.form, config);

      //   //lets get the second request
      // const categoryRequest = axios.post('/store');

      // axios.all([fileUploadRequest, ategoryRequest]).then(axios.spread((...responses) =>{

      //     const fileUploadResponse = responses[0]
      //     const categoryResponse = responses[1]

      //     console.log(fileUploadResponse, categoryResponse)

      //  } ))  .catch(errors => {
      //         // react on errors.
      //      console.error(errors);
      //     })

      axios
        .post("/submit", this.form, config)
        .then((Res) => {
          //success
          this.isActive = true;
          this.hasError = false;
          this.success = Res.data.success;
          JSON.parse(this.success);
        })
        .catch((error) => {
          this.hasError = true;
          this.errors =
            error.response.data.errors || error.response.data.message;
        });

      this.attachments = [];
      document.getElementById("upload-file").value = "";
    },
  },
  mounted() {
    console.log("Component mounted.");
    this.cat.name = true;
  },
};
</script>

