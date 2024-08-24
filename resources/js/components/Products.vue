<template>
    <div>
        <div class="search-bar">
            <select v-model="selectedColumn">
                <option value="name">Name</option>
                <option value="address">Address</option>
                <option value="contact">Contact</option>
            </select>

            <input type="text" v-model="searchQuery" @input="search" placeholder="Search..."/>
        </div>

        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Contact</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="producer in filteredProducers" :key="producer.id">
                <td>{{ producer.name }}</td>
                <td>{{ producer.address }}</td>
                <td>{{ producer.contact }}</td>
            </tr>
            </tbody>
        </table>
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
                producer[this.selectedColumn]
                    .toLowerCase()
                    .includes(this.searchQuery.toLowerCase())
            );
        },
    },
    methods: {
        fetchProducers() {
            // Fetch the data from your API (assumed to be at /api/producers)
            axios.get("/api/producers").then(response => {
                this.producers = response.data;
            });
        },
        search() {
            // This method is triggered on input event
            // No additional logic needed since computed property handles filtering
        },
    },
    mounted() {
        this.fetchProducers();
    },
};
</script>
