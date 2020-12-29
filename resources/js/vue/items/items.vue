<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo list</h2>
            <add-item-form v-on:reloadList="getList()" />
        </div>
        <list-item-view :items="items" v-on:reloadList="getList()" />
    </div>
</template>

<script>
import addItemForm from "./addItemForm.vue";
import listItemView from "./listItemView";

export default {
    components: {
        addItemForm,
        listItemView
    },
    data: function() {
        return {
            items: []
        };
    },
    methods: {
        getList() {
            axios.get("api/items").then(resp => {
                this.items = resp.data;
            });
        },
        created() {}
    }
};
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
