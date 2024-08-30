<template>
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

        <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>

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
                <li class="page-item"><button @click="prevPage" :disabled="!products.prev_page_url">Previous</button></li>
                <li class="page-item"><button @click="nextPage" :disabled="!products.next_page_url">Next</button></li>
            </ul>
        </nav>
    </div>

    <div v-if="!isProductSelection">
        <div class="card mt-5">
            <h2 class="card-header">Select an order and amount</h2>
            <div class="card-body">
                <form action="/order_items" method="post">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <input type="hidden" name="product_id" :value="productID">

                    <div class="mb-3">
                        <label for="order_id" class="form-label">Order ID:</label>
                        <input type="text" name="order_id" class="form-control" id="order_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount:</label>
                        <input type="number" name="amount" class="form-control" id="amount" required>
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
            productID: 0,
            page: 1,
            isProductSelection: true,
        };
    },
    computed: {
        csrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
        computed: {
            csrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            },
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
            this.productID = id;
            this.isProductSelection = false;
        },
        // proceed() {
        //     fetch('/order_items', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': this.csrfToken
        //         },
        //     });
        // },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>
