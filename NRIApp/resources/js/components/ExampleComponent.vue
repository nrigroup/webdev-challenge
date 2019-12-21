<template>
  <div style="margin-top:10px">
    <h2>NRI App</h2>
    <p>Select csv file to populate table</p>
    <input type="file" id="file" ref="myFiles" @change="previewFiles" accept=".csv" />

    <br><br>
    <div v-if="spm">
      <h4>Total Spending Per Month</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Total Tax Amount ($)</th>
            <th>Month</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, i) in spm" :key="spm[i]">
            <td v-for="(col, j) in row" :key="col[j]">{{col}}</td>
          </tr>
        </tbody>
      </table>
      <h4>Total Spending Per Category</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Total Tax Amount ($)</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, i) in spc" :key="spc[i]">
            <td v-for="(col, j) in row" :key="col[j]">{{col}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>Add CSV file</div>
  </div>
</template>

<script>
var Papa = require("papaparse");

export default {
  data() {
    // var spm1 = Object.assign({}, spm1, )
    return {
      name: "Sang",
      files: [],
      rowData: null,
      spm1: Object.assign({}, spm1, )
    };
  },
  props: ["spm", "spc"],
  methods: {
    previewFiles(event) {
      this.files = event.target.files[0];
      var self = this;
      Papa.parse(this.files, {
        complete: function(result) {
          //   console.log(result);
          self.rowData = result["data"];
          self.rowData.shift();
          console.log(self.rowData);

          //send to backend
          axios
            .post("/", { items: self.rowData })
            .then(function(response) {
              console.log("success response");
              //   console.log(response.data);
              location.reload();
            })
            .catch(function(error) {
              console.log(error);
            });
        }
      });
    }
  },
  mounted() {
    console.log("Component mounted.");
    console.log(this.name);
  }
};
</script>
