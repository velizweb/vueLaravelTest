<template>
    <div>
        <b-table
            striped
            hover
            head-variant="dark"
            responrive
            :items="users"
            :fields="fields"
        >
            <!-- A virtual composite column -->
            <template #cell(options)="data">
                <button @click="editUser(data.item.id)" class="edit">
                    <font-awesome-icon icon="edit" />
                </button>
                <button
                    @click="confirmRemoveUser(data.item.id)"
                    class="trashcan"
                >
                    <font-awesome-icon icon="trash" />
                </button>
            </template>
        </b-table>

        <!-- Modal Edit -->
        <Modal v-model="show_modal_1" title="Update user">
            <form novalidate>
                <div class="form-group">
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
                <hr class="full-hr" />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <button
                                class="btn btn-success"
                                type="button"
                                @click="updateUser()"
                            >
                                Update
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

        <!-- Modal Edit -->
        <Modal v-model="show_modal_confirm" title="Confirm delete user">
            <div class="row">
                <div
                    class="d-flex justify-content-center align-content-center pl-3"
                >
                    You want to delete the record?
                </div>
            </div>
            <hr class="full-hr" />
            <div class="row">
                <div class="col-sm-12">
                    <div class="float-right">
                        <button
                            class="btn btn-success"
                            type="button"
                            @click="removeUser()"
                        >
                            Delete
                        </button>
                        <button
                            class="btn btn-secondary ml-2"
                            type="button"
                            @click="show_modal_confirm = false"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getUsers();
    },
    data: function() {
        return {
            isLoading: false,
            show_modal_1: false,
            show_modal_confirm: false,
            users: [],
            user: {
                email: "",
                name: ""
            },
            fields: [
                {
                    key: "name",
                    sortable: true
                },
                {
                    key: "email",
                    sortable: true
                },
                {
                    key: "created_at"
                },
                "options"
            ],
            userDelete: null
        };
    },
    methods: {
        getUsers() {
            axios
                .get("api/users")
                .then(resp => {
                    this.users = resp.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        confirmRemoveUser(id) {
            this.show_modal_confirm = true;
            this.userDelete = id;
        },
        removeUser() {
            axios
                .delete("api/user/" + this.userDelete)
                .then(resp => {
                    if (resp.status == 201) {
                        this.show_modal_confirm = false;
                        this.getUsers();
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editUser(id) {
            this.show_modal_1 = true;
            axios
                .get("api/user/" + id)
                .then(resp => {
                    this.user = { ...this.user, ...resp.data };
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateUser() {
            axios
                .put("api/user/" + this.user.id, {
                    name: this.user.name,
                    email: this.user.email
                })
                .then(resp => {
                    if (resp.status == 201) {
                        this.show_modal_1 = false;
                        this.getUsers();
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
<style scoped>
.edit,
.trashcan {
    background: #e6e6e6;
    border: 0px;
    outline: none;
}

.trashcan {
    color: #ff0000;
}

.edit {
    color: #0683b4;
}
</style>
