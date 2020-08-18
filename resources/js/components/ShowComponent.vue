<template>
    <div class="summary">
        <img :src="'https://image.tmdb.org/t/p/w342/' + movie['poster_path']">
        <ul class="characteristics">
            <li>
                <span>Title</span>
                <span>{{ movie['title'] }}</span>
            </li>
            <li v-if="movie['title'] !== movie['original_title'] ">
                <span>Original title</span>
                <span>{{ movie['original_title'] }}</span>
            </li>
            <li v-if="movie['tagline']">
                <span>Tagline</span>
                <span>{{ movie['tagline'] }}</span>
            </li>
            <li>
                <span>Genres</span>
                <span>
                    <template v-for="genre in movie['genres']">{{ genre['name'] }}, </template>
                </span>
            </li>
            <li>
                <span>Spoken languages</span>
                <span>
                    <template v-for="language in movie['spoken_languages']">{{ language['name'] }}, </template>
                </span>
            </li>
            <li>
                <span>Production countries</span>
                <span>
                    <template v-for="country in movie['production_countries']">{{ country['name'] }}, </template>
                </span>
            </li>
            <li>
                <span>Production companies</span>
                <span>
                    <template v-for="company in movie['production_companies']">{{ company['name'] }}, </template>
                </span>
            </li>
            <li v-if="movie['homepage']">
                <span>Homepage</span>
                <span><a target="_blank" :href="movie['homepage']">Link</a></span>
            </li>
            <li>
                <span>Status</span>
                <span>{{ movie['status'] }}</span>
            </li>
            <li v-if="movie['budget'] > 0">
                <span>Budget</span>
                <span>{{ movie['budget'] }} $</span>
            </li>
            <li>
                <span>Release date</span>
                <span>{{ movie['release_date'] }}</span>
            </li>
            <li v-if="movie['runtime'] > 0">
                <span>Runtime</span>
                <span>{{ movie['runtime'] }} min</span>
            </li>
            <li>
                <span>Overview</span>
                <span>{{ movie['overview'] }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        movieRoute: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            movie: ''
        }
    },
    mounted() {
        this.fetchMovieById()
    },
    methods: {
        fetchMovieById() {
            axios.get(this.movieRoute).then(response => {
                console.log(response.data)
                this.movie = response.data
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

.summary {
    height: 100%;
    display: flex;
    justify-content: space-between;
    padding: 3% 2%;
}

img {
    height: 50%
}

.characteristics {
    padding: 0;
    margin-left: 20px;
}

.characteristics li {
    display: flex;
    justify-content: space-between;
    font-size: 1.2em;
    border-bottom: 3px dotted black;
    padding-top: 5px;
}

.characteristics li:last-child {
    align-items: center;
    flex-direction: column;
    border-bottom: none;
}

</style>
