<template>
    <label v-if="errorMessage !== null" class="alert alert-danger">{{ errorMessage }}</label>
    <div v-if="isProductSelection">
        <h2 class="card-header">Add products to order</h2>
        <div class="input-group">
            <div class="form-outline" style="display: flex" data-mdb-input-init>
                <input class="form-control" v-model="searchQuery" @keyup.enter="fetchProducts" placeholder="Search..." />
                <button class="form-control" @click="fetchProducts">Search</button>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="id">ID</option>
            <option value="name">Name</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                    <tr>
                        <th style="width: 80px">ID</th>
                        <th>Name</th>
                        <th style="width: 250px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products.data" :key="products.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>
                            <button class="btn btn-primary" @click="nextRoute(product.id)">Select</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="navClassLeft"><button class="page-link" @click="prevPage" :disabled="!products.prev_page_url">Previous</button></li>
                <li :class="navClassRight"><button class="page-link" @click="nextPage" :disabled="!products.next_page_url">Next</button></li>
            </ul>
        </nav>
    </div>

    <div v-if="!isProductSelection">
        <div class="card mt-5">
            <h2 class="card-header">Select an order and amount</h2>
            <div class="card-body">
                <form @submit.prevent="createOrderItem">
                    <input type="hidden" v-model="product_id">

                    <div class="mb-3">
                        <label for="order_id" class="form-label">Order ID:</label>
                        <input type="text" v-model="order_id" class="form-control" id="order_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount:</label>
                        <input type="number" v-model="amount" class="form-control" id="amount" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add to Order</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: '',
            selectedColumn: 'name',
            products: {},
            product_id: 0,
            order_id: null,
            amount: null,
            page: 1,
            errorMessage: null,
            isProductSelection: true,
        };
    },
    computed: {
        csrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },
        navClassLeft() {
            if (!this.products.prev_page_url) {
                return "page-item disabled";
            }
            else {
                return "page-item";
            }
        },
        navClassRight() {
            if (!this.products.next_page_url) {
                return "page-item disabled";
            }
            else {
                return "page-item";
            }
        },
    },
    methods: {
        fetchProducts(page = 1) {
            axios.get("http://localhost/products_api", {
                params: {
                    search: this.searchQuery,
                    column: this.selectedColumn,
                    page: this.page,
                },
            }).then(response => {
                this.products = response.data;
            });
        },
        nextPage() {
            if (this.products.next_page_url) {
                this.page++;
                this.fetchProducts(this.page);
            }
        },
        prevPage() {
            if (this.products.prev_page_url) {
                this.page--;
                this.fetchProducts(this.page);
            }
        },
        nextRoute(id) {
            this.product_id = id;
            this.isProductSelection = false;
        },
        async createOrderItem() {
            try {
                const response = await axios.post('/order_items', {
                    order_id: this.order_id,
                    product_id: this.product_id,
                    amount: this.amount
                });

                if (response.data === 'StockError') {
                    this.errorMessage = "Not enough products in stock";
                }
                if (response.data === 'Success') {
                    window.location.href = 'http://localhost/order_items';
                }
            } catch (error) {
                console.log(error);
                this.errorMessage = error.response.data.errors;
            }
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>
