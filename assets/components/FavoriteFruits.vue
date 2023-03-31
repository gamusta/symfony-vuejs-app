<template>
  <div class="container">
    <h2>Favorite Fruits</h2>
    <div class="col-sm-12">
      <div class="offset">
        <table class="table table-bordered">
          <caption>List of fruits</caption>
          <thead>
          <tr>
            <th>Name</th>
            <th>Family</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="f in fruits">
            <td>{{ f.name }}</td>
            <td>{{ f.family }}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <h3>Sum of nutritions facts</h3>
      <div><strong>calories</strong> : {{ sum.calories }}</div>
      <div><strong>fat</strong> : {{ sum.fat }}</div>
      <div><strong>protein</strong> : {{ sum.protein }}</div>
      <div><strong>carbohydrates</strong> : {{ sum.carbohydrates }}</div>
      <div><strong>sugar</strong> : {{ sum.sugar }}</div>
    </div>
  </div>
</template>

<script>
import FruitService from "../services/FruitService";

export default {
  name: 'fruits',
  data() {
    return {
      fruits: [],
      sum: {}
    };
  },
  methods: {
    getFruits() {
      this.fruits = Object.values(FruitService.getFavorites());
    },
    getSum() {
      let sum = {calories: 0, fat: 0, protein: 0, carbohydrates: 0, sugar: 0};
      for (const f of this.fruits) {
        sum.calories += f.calories;
        sum.fat += f.fat;
        sum.protein += f.protein;
        sum.carbohydrates += f.carbohydrates;
        sum.sugar += f.sugar;
      }
      this.sum = sum;
    }
  },
  watch: {
    fruits() {
      this.getSum();
    }
  },
  created() {
    this.getFruits()
  }
};
</script>