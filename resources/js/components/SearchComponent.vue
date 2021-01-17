<template>
    <form class="search-form" method="get" :action="searchRoute">
        <input type="text" v-model="query" name="search_query" maxlength="30" required>
        <input type="submit" :value="translation.search" :disabled="!query">
    </form>
</template>

<script>
export default {
    props: {
        translation: {
            type: Object,
            required: true
        },
        searchRoute: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            query: '',
        }
    }
}
</script>
