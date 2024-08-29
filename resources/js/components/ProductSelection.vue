<template>
    <div>
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
                            <a class="btn btn-primary" :href="nextRoute(product.id)">Select</a>
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
</template>

<script>
export default {
    data() {
        return {
            searchQuery: '',
            selectedColumn: 'name',
            products: {},
            page: 1,
        };
    },
    methods: {
        fetchProducts(page = 1) {
            axios.get("create/products_api", {
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
            return `/order_items/orderSelection/${id}`;
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>
