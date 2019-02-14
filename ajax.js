const app = new Vue({
    template: `
    <div class="row" class="store-items">
        <div
            class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item skinz" data-item="skinz"
            v-for="product in items"
        >
          <div class="card ">
            <div class="img-container">
              <img src="img/skin-1.jpg" class="card-img-top store-img" alt="">
              <span class="store-item-icon">
                <i class="fas fa-shopping-cart"></i>
              </span>
            </div>
            <div class="card-body">
              <div class="card-text d-flex justify-content-between text-capitalize">
                <h5 id="store-item-name">{{ product.name }}</h5>
                <h5 class="store-item-value">£ <strong id="store-item-price" class="font-weight-bold">{{ product.cost }}</strong></h5>
              </div>
            </div>
          </div>
        </div>
    </div>
    `,

    data: {
        items: []
    },

    async mounted () {
        this.items = await axios.get('http://localhost/products.php').then(({ data }) => data)
    }


}).$mount('#store-items')
