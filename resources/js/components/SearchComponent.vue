<template>
    <form method="get" :action="searchRoute+'/'+query">
        <input type="text" v-model="query">
        <button><i class="fas fa-search"></i></button>
    </form>
</template>

<script>
export default {
    props: {
        searchRoute: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            query: ''
        }
    }
}
</script>

<style scoped lang="scss">
form {
    display: inline;
}
</style>
