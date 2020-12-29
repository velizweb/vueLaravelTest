<template>
    <div class="pt-3">
        <div
            class="d-flex flex-row justify-content-between align-content-center  mb-3"
        >
            <div class="text-dark title">List users</div>
            <button class="btn btn-info" @click="handleLogout()">
                Cerrar sesion
            </button>
        </div>
        <users />
    </div>
</template>
<script>
import Users from "./../vue/users/users";
export default {
    components: {
        Users
    },
    methods: {
        handleLogout() {
            axios
                .get("api/auth/logout")
                .then(resp => {
                    if (resp.data.status == "success") {
                        this.$router.push("/");
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
.title {
    font-size: 24px;
}
</style>
