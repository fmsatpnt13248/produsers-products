<template>
    <div class="card mt-5">
        <div class="card-body">
            <label v-if="errorMessage !== null" class="alert alert-danger">{{ errorMessage }}</label>
            <div class="mb-3">
                <label for="name" class="form-label">Username:</label>
                <input type="text" v-model="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" v-model="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" v-model="password" class="form-control" id="password">
            </div>
            <button @click.prevent="logIn()" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            email: null,
            password: null,
            users: {},
            errorMessage: null,
        };
    },
    methods: {
        fetchUsers() {
            axios.get("http://localhost/users_api")
                .then(response => {
                this.users = response.data;
            });
        },
        async logIn() {
            if (this.name == null || this.email == null || this.password == null) {
                this.errorMessage = "All fields are required";
                return;
            }
            try {
                const response = await axios.post('login', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                });

                console.log(response);

                if (response.data === 'EmailError') {
                    this.errorMessage = "Email was not found";
                }
                if (response.data === 'UserError') {
                    this.errorMessage = "Invalid username entered";
                }
                if (response.data === 'PassError') {
                    this.errorMessage = "Invalid password entered";
                }
                if (response.data === 'Success') {
                    window.location.href = 'http://localhost/producers';
                }
            } catch (error) {
                console.log(error);
                this.errorMessage = error.response.data.errors;
            }
        },
    },
    mounted() {
        this.fetchUsers();
    },
};
</script>
