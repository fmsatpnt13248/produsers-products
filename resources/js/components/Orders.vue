<template>
    <div>
        <div class="input-group">
            <div class="form-outline" style="display: flex" data-mdb-input-init>
                <input class="form-control" v-model="searchQuery" @keyup.enter="fetchOrders" placeholder="Search..." />
                <button class="form-control" @click="fetchOrders">Search</button>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="id">ID</option>
            <option value="price_total">Total price</option>
            <option value="status">Status</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th style="width: 80px">ID</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th style="width: 250px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders.data" :key="orders.id">
                            <td>{{ order.id }}</td>
                            <td>{{ order.price_total }}</td>
                            <td>{{ order.status }}</td>
                            <td>
                                <div style="display: flex">
                                    <a class="btn btn-primary" :href="editRoute(order.id)">Edit</a>

                                    <button style="margin-left: 10px"  @click="deleteItem(order.id)" class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="navClassLeft"><button class="page-link" @click="prevPage" :disabled="!orders.prev_page_url">Previous</button></li>
                <li :class="navClassRight"><button class="page-link" @click="nextPage" :disabled="!orders.next_page_url">Next</button></li>
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
            orders: {},
            page: 1
        };
    },
    computed: {
        navClassLeft() {
            if (!this.orders.prev_page_url) {
                return "page-item disabled";
            }
            else {
                return "page-item";
            }
        },
        navClassRight() {
            if (!this.orders.next_page_url) {
                return "page-item disabled";
            }
            else {
                return "page-item";
            }
        },
    },
    methods: {
        fetchOrders(page = 1) {
            axios.get("orders_api", {
                params: {
                    search: this.searchQuery,
                    column: this.selectedColumn,
                    page: this.page,
                },
            }).then(response => {
                this.orders = response.data;
            });
        },
        nextPage() {
            if (this.orders.next_page_url) {
                this.page++;
                this.fetchOrders(this.page);
            }
        },
        prevPage() {
            if (this.orders.prev_page_url) {
                this.page--;
                this.fetchOrders(this.page);
            }
        },
        deleteItem(id) {
            axios.delete(`orders/${id}`)
                .then(response => {
                    console.log(`Deleted post with ID ${id}`);
                    this.fetchOrders();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        editRoute(id) {
            return `/orders/${id}/edit`;
        },
    },
    mounted() {
        this.fetchOrders();
    },
};
</script>
