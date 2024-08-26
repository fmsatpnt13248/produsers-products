<template>
    <div>
        <div class="input-group">
            <div class="form-outline" style="display: flex" data-mdb-input-init>
                <input class="form-control" v-model="searchQuery" @keyup.enter="fetchProducers" placeholder="Search..." />
                <button class="form-control" @click="fetchProducers">Search</button>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="id">ID</option>
            <option value="name">Name</option>
            <option value="address">Address</option>
            <option value="contact">Contact</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th style="width: 80px">ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Info</th>
                            <th style="width: 250px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producer in producers.data" :key="producers.id">
                            <td>{{ producer.id }}</td>
                            <td>{{ producer.name }}</td>
                            <td>{{ producer.address }}</td>
                            <td>{{ producer.contact }}</td>
                            <td>
                                <div style="display: flex">
                                    <a class="btn btn-primary" :href="editRoute(producer.id)">Edit</a>

                                    <button @click="deleteItem(producer.id)" class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><button @click="prevPage" :disabled="!producers.prev_page_url">Previous</button></li>
                <li class="page-item"><button @click="nextPage" :disabled="!producers.next_page_url">Next</button></li>
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
            producers: {},
            page: 1
        };
    },
    computed: {
        csrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },
    },
    methods: {
        fetchProducers(page = 1) {
            axios.get("producers_api", {
                params: {
                    search: this.searchQuery,
                    column: this.selectedColumn,
                    page: this.page,
                },
            }).then(response => {
                this.producers = response.data;
            });
        },
        nextPage() {
            if (this.producers.next_page_url) {
                this.page++;
                this.fetchProducers(this.page);
            }
        },
        prevPage() {
            if (this.producers.prev_page_url) {
                this.page--;
                this.fetchProducers(this.page);
            }
        },
        deleteItem(id) {
            axios.delete(`producers/${id}`)
                .then(response => {
                    console.log(`Deleted post with ID ${id}`);
                    this.fetchProducers();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        // deleteRoute(id) {
        //     return `/producers/${id}`;
        // },
        editRoute(id) {
            return `/producers/${id}/edit`;
        },
    },
    mounted() {
        this.fetchProducers();
    },
};
</script>
