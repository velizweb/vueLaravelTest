<template>
    <div class="d-flex flex-column">
        <div
            class="d-flex justify-content-center align-content-center pt-5 pb-5 text-test text-primary"
        >
            VUE, BOOTSTRAP AND LARAVEL (TEST)
        </div>
        <div class="d-flex justify-content-center">
            <div
                class="col-md-4 d-flex align-content-center  justify-content-between pt-5 pb-5"
            >
                <button type="button" class="btn btn-success" @click="login()">
                    Login
                </button>
                <button type="button" class="btn btn-info" @click="register()">
                    Register
                </button>
            </div>
        </div>

        <Modal v-model="show_modal_1" :title="type">
            <form novalidate>
                <div class="form-group" v-if="type == 'Register user'">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Enter name"
                        v-model="user.name"
                    />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        placeholder="Enter email"
                        v-model="user.email"
                    />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="Enter password"
                        v-model="user.password"
                    />
                </div>

                <hr class="full-hr" />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <button
                                class="btn btn-primary"
                                type="button"
                                @click="handleRegister()"
                                v-if="type == 'Register user'"
                            >
                                <b-spinner
                                    small
                                    label="Small Spinner"
                                    v-if="isLoading"
                                ></b-spinner>
                                Register
                            </button>
                            <button
                                class="btn btn-success"
                                type="button"
                                @click="handleLogin()"
                                v-else
                            >
                                <b-spinner
                                    small
                                    label="Small Spinner"
                                    v-if="isLoading"
                                ></b-spinner>
                                Login
                            </button>
                            <button
                                class="btn btn-secondary ml-2"
                                type="button"
                                @click="show_modal_1 = false"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </Modal>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            show_modal_1: false,
            type: "",
            isLoading: false,
            user: {
                email: "",
                password: "",
                name: ""
            }
        };
    },
    methods: {
        login() {
            this.type = "Login user";
            this.show_modal_1 = true;
        },
        register() {
            this.type = "Register user";
            this.show_modal_1 = true;
        },
        handleLogin() {
            this.isLoading = true;
            axios
                .post("api/auth/login", {
                    email: this.user.email,
                    password: this.user.password
                })
                .then(resp => {
                    if (resp.data.status == "success") {
                        this.isLoading = false;
                        this.show_modal_1 = false;
                        this.$router.push("Users");
                    } else {
                        this.isLoading = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        handleRegister() {
            this.isLoading = true;
            axios
                .post("api/auth/register", {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password
                })
                .then(resp => {
                    if (resp.status == 201) {
                        this.isLoading = false;
                        this.show_modal_1 = false;
                        confirmRegister();
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        confirmRegister() {
            this.$bvToast.toast("Registration was successful", {
                title: "Confirmation of registration",
                autoHideDelay: 8000,
                appendToast: true
            });
        }
    }
};
</script>

<style scoped>
.text-test {
    font-size: 40px;
}
</style>
