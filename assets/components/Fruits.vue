<template>
  <div class="container">
    <h2>All Fruits</h2>
    <form class="row p-3">
      <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" v-model="searchName" class="form-control" id="name" placeholder="Name">
        </div>
      </div>
      <div class="row mb-3">
        <label for="family" class="col-sm-2 col-form-label">Family</label>
        <div class="col-sm-10">
          <input type="text" v-model="searchFamily" class="form-control" id="family" placeholder="Family">
        </div>
      </div>
    </form>

    <div class="col-sm-12">
      <div class="offset">
        <table class="table table-bordered">
          <caption>List of fruits</caption>
          <thead>
          <tr>
            <th>Name</th>
            <th>Family</th>
            <th>Favorite</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="f in displayedFruits">
            <td>{{ f.name }}</td>
            <td>{{ f.family }}</td>
            <td>
              <input
                  type="checkbox"
                  :value="f.id"
                  id="f.id"
                  v-model="favoriteIds"
                  @change="toggleFavourite(f)"
              >
            </td>
            <td>
              <router-link :to="'/fruits/' + f.id">Details</router-link>
            </td>
          </tr>
          </tbody>
        </table>
        <nav aria-label="Page navigation" style="display:flex; justify-content:space-around;">
          <ul class="pagination">
            <li class="page-item" v-if="page !== 1">
              <a class="page-link" href="#" @click="page--"> Previous </a>
            </li>
            <li
                class="page-item"
                v-for="pageNumber in pages"
            >
              <a class="page-link" href="#" @click="page = pageNumber">
                {{ pageNumber }}
              </a>
            </li>
            <li class="page-item" v-if="page < pages.length">
              <a class="page-link" href="#" @click="page++"> Next </a>
            </li>
          </ul>
        </nav>
      </div>
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
      filteredFruits: [],
      page: 1,
      perPage: 10,
      pages: [],
      searchName: '',
      searchFamily: '',
      favoriteIds: [],
    };
  },
  methods: {
    getFruits() {
      FruitService.getAll()
          .then((response) => {
            this.fruits = this.filteredFruits = response.data;
            this.setPages();
          })
          .catch(e => {
            console.log(e);
          });
    },
    toggleFavourite(fruit) {
      const favoriteFruits = JSON.parse(localStorage.getItem('favoriteFruits')) || {};
      if (favoriteFruits[fruit.id]) {
        delete favoriteFruits[fruit.id]
      } else if (Object.keys(favoriteFruits).length >= 10) {
        this.favoriteIds = this.favoriteIds.slice(0, -1);
        alert('Max 10 favorites are allowed !');
      } else {
        favoriteFruits[fruit.id] = fruit;
      }
      FruitService.setFavorites(favoriteFruits);
    },
    getFavoriteIds() {
      this.favoriteIds = Object.keys(FruitService.getFavorites());
    },
    setPages() {
      let numberOfPages = Math.ceil(this.filteredFruits.length / this.perPage);
      this.pages = [];
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate() {
      const fruits = this.filteredFruits;
      const maxPages = Math.ceil(fruits.length / this.perPage);
      this.page = Math.max(1, Math.min(this.page, maxPages));
      let from = this.page * this.perPage - this.perPage;
      let to = this.page * this.perPage;
      return fruits.slice(from, to);
    },
  },
  computed: {
    displayedFruits() {
      let fruits = this.fruits;
      const searchName = this.searchName.toLowerCase().trim();
      if (searchName) {
        fruits = fruits.filter(fruit => {
          return fruit.name.toLowerCase().indexOf(searchName) >= 0;
        });
      }
      const searchFamily = this.searchFamily.toLowerCase().trim();
      if (searchFamily) {
        fruits = fruits.filter(fruit => {
          return fruit.family.toLowerCase().indexOf(searchFamily) >= 0;
        });
      }
      this.filteredFruits = fruits;
      return this.paginate();
    }
  },
  watch: {
    fruits() {
      this.setPages();
    },
    filteredFruits() {
      this.setPages();
    },
  },
  created() {
    this.getFavoriteIds();
    this.getFruits();
  }
};
</script>