<template>
    <div>
        <div class="input-group">
            <div class="form-outline" style="display: flex" data-mdb-input-init>
                <input class="form-control" v-model="searchQuery" @keyup.enter="fetchOrderItems" placeholder="Search..." />
                <button class="form-control" @click="fetchOrderItems">Search</button>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="id">ID</option>
            <option value="order_id">Order ID</option>
            <option value="product_id">Product ID</option>
            <option value="price">Price</option>
            <option value="amount">Amount</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th style="width: 80px">ID</th>
                            <th>Order ID</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th style="width: 250px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in order_items.data" :key="order_items.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.order_id }}</td>
                            <td>{{ item.product_id }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.amount }}</td>
                            <td>
                                <div style="display: flex">
                                    <a class="btn btn-primary" :href="editRoute(item.id)">Edit</a>

                                    <button @click="deleteItem(item.id)" class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><button @click="prevPage" :disabled="!order_items.prev_page_url">Previous</button></li>
                <li class="page-item"><button @click="nextPage" :disabled="!order_items.next_page_url">Next</button></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: '',
            selectedColumn: 'id',
            order_items: {},
            page: 1
        };
    },
    methods: {
        fetchOrderItems(page = 1) {
            axios.get("order_items_api", {
                params: {
                    search: this.searchQuery,
                    column: this.selectedColumn,
                    page: this.page,
                },
            }).then(response => {
                this.order_items = response.data;
            });
        },
        nextPage() {
            if (this.order_items.next_page_url) {
                this.page++;
                this.fetchOrderItems(this.page);
            }
        },
        prevPage() {
            if (this.order_items.prev_page_url) {
                this.page--;
                this.fetchOrderItems(this.page);
            }
        },
        deleteItem(id) {
            axios.delete(`order_items/${id}`)
                .then(response => {
                    console.log(`Deleted post with ID ${id}`);
                    this.fetchOrderItems();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        editRoute(id) {
            return `/order_items/${id}/edit`;
        },
    },
    mounted() {
        this.fetchOrderItems();
    },
};
</script>
