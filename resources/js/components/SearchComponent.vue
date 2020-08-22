<template>
    <form method="get" :action="searchRoute+'/'+query">
        <input @mouseover="hover = true" @mouseleave="hover = false" type="text" v-model="query" maxlength="30" required>
        <button :class="{hoverButton:hover}" :disabled="!query"><i class="fas fa-search"></i></button>
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
            query: '',
            hover: false
        }
    }
}
</script>

<style scoped lang="scss">
@import "node_modules/bootstrap/scss/functions";
@import "node_modules/bootstrap/scss/variables";
@import "node_modules/bootstrap/scss/mixins/_breakpoints";

form {
    display: inline;
    width: 100px;
    @include media-breakpoint-down(sm) {
        width: 100%;
    }

    input {
        &:hover {
            border: initial;
            padding: 1px 2px;
        }

        &:focus {
            outline: none;
        }
    }

    button {
        border: 0.1px solid gray;
        border-left: 0;
        margin-left: -5px;
        padding: 2.6px 5px 3.8px 5px;
        background-color: white;
    }

    .hoverButton {
        border: 0;
        padding: 1.2px 5px 2.8px 5px;
    }
}
</style>
