<template>
    <div>
        <div class="input-group">
            <div class="form-outline" style="display: flex" data-mdb-input-init>
                <input class="form-control" v-model="searchQuery" @keyup.enter="fetchProducts" placeholder="Search..." />
                <button class="form-control" @click="fetchProducts">Search</button>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="name">Name</option>
            <option value="detail">Details</option>
            <option value="producer_id">Producer ID</option>
            <option value="price">Price</option>
            <option value="amount">Amount</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                    <tr>
                        <th style="width: 80px">ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Producer ID</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th style="width: 250px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products.data" :key="products.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.detail }}</td>
                        <td>{{ product.producer_id }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.amount }}</td>
                        <td>
                            <div style="display: flex">
                                <a class="btn btn-primary" :href="editRoute(product.id)">Edit</a>

                                <button style="margin-left: 10px"  @click="deleteItem(product.id)" class="btn btn-danger">Delete</button>
                            </div>
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
    computed: {
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
            axios.get("products_api", {
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
        deleteItem(id) {
            axios.delete(`products/${id}`)
                .then(response => {
                    console.log(`Deleted post with ID ${id}`);
                    this.fetchProducts();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        editRoute(id) {
            return `/products/${id}/edit`;
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>
