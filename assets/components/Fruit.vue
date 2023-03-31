<template>
  <div v-if="fruit">
    <h4>Fruit Detail</h4>
    <div><strong>Name</strong> : {{ fruit.name }}</div>
    <div><strong>Family</strong> : {{ fruit.family }}</div>
    <div><strong>Genus</strong> : {{ fruit.genus }}</div>
    <div><strong>Order</strong> : {{ fruit.orders }}</div>
    <div><strong>Calories</strong> : {{ fruit.calories }}</div>
    <div><strong>Carbohydrates</strong> : {{ fruit.carbohydrates }}</div>
    <div><strong>Fat</strong> : {{ fruit.fat }}</div>
    <div><strong>Protein</strong> : {{ fruit.protein }}</div>
    <div><strong>Sugar</strong> : {{ fruit.sugar }}</div>
  </div>
</template>

<script>
import FruitService from "../services/FruitService";

export default {
  name: "fruit",
  data() {
    return {
      fruit: null,
    };
  },
  methods: {
    getFruit(id) {
      FruitService.get(id)
          .then(response => {
            this.fruit = response.data;
          })
          .catch(e => {
            console.log(e);
          });
    },
  },
  created() {
    this.getFruit(this.$route.params.id);
  }
};
</script>
