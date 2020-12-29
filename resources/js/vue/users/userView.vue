<template> </template>
<script>
export default {
    mounted() {
        getUsers();
    },
    data: function() {
        return {
            users: []
        };
    },
    methods: {
        getUsers() {
            axios
                .get("api/users")
                .then(resp => {
                    this.users = resp.data;
                    console.log(this.users);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
