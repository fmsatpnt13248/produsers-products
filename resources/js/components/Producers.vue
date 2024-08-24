<template>
    <div>
        <div class="input-group">
            <div class="form-outline" data-mdb-input-init>
                <input class="form-control" type="text" v-model="searchQuery" @input="search" placeholder="Search..."/>
            </div>
        </div>
        <select class="form-select" style="width: 250px; margin-top: 10px" v-model="selectedColumn">
            <option value="name">Name</option>
            <option value="address">Address</option>
            <option value="contact">Contact</option>
        </select>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producer in filteredProducers" :key="producer.id">
                            <td>{{ producer.id }}</td>
                            <td>{{ producer.name }}</td>
                            <td>{{ producer.address }}</td>
                            <td>{{ producer.contact }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: "",
            selectedColumn: "name",
            producers: {},
        };
    },
    computed: {
        filteredProducers() {
            return Object.values(this.producers).filter(producer =>
                producer[this.selectedColumn].toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
    },
    methods: {
        fetchProducers() {
            axios.get("api/producers_api").then(response => {
                this.producers = response.data;
            });
        },
        search(){},
    },
    mounted() {
        this.fetchProducers();
    },
};
</script>
