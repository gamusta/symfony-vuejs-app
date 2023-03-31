import http from "../http-common";

class FruitService {
    getAll() {
        return http.get("/fruits");
    }

    get(id) {
        return http.get(`/fruits/${id}`);
    }

    getFavorites() {
        return JSON.parse(localStorage.getItem('favoriteFruits')) || {};
    }

    setFavorites(fruits) {
        localStorage.setItem('favoriteFruits', JSON.stringify(fruits));
    }
}

export default new FruitService();
