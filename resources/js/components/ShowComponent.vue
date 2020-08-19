<template>
    <div v-if="loaded" class="summary">
        <div class="error" v-if="error">Movie don't exist :(</div>
        <template v-else>
            <img v-if="movie['poster_path']" :src="'https://image.tmdb.org/t/p/w342/' + movie['poster_path']">
            <img v-else :src="posterPlaceholder" alt="Poster placeholder">
            <ul class="characteristics">
                <li>
                    <span>Title</span>
                    <span>{{ movie['title'] }}</span>
                </li>
                <li v-if="movie['title'] !== movie['original_title'] ">
                    <span>Original title</span>
                    <span>{{ movie['original_title'] }}</span>
                </li>
                <li v-show="movie['tagline']">
                    <span>Tagline</span>
                    <span>{{ movie['tagline'] }}</span>
                </li>
                <li v-if="movie['genres'].length !== 0">
                    <span>Genres</span>
                    <span>{{ this.extract(movie['genres']) }}</span>
                </li>
                <li v-if="movie['spoken_languages'].length !== 0">
                    <span>Spoken languages</span>
                    <span>
                        {{ this.extract(movie['spoken_languages']) }}
                    </span>
                </li>
                <li v-show="movie['production_countries'].length !== 0">
                    <span>Production countries</span>
                    <span>
                        {{ this.extract(movie['production_countries']) }}
                    </span>
                </li>
                <li v-if="movie['production_companies'].length !== 0">
                    <span>Production companies</span>
                    <span>
                        {{ this.extract(movie['production_companies']) }}
                    </span>
                </li>
                <li v-show="movie['homepage']">
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
                <li v-show="movie['release_date']">
                    <span>Release date</span>
                    <span>{{ movie['release_date'] }}</span>
                </li>
                <li v-if="movie['runtime'] > 0">
                    <span>Runtime</span>
                    <span>{{ movie['runtime'] }} min</span>
                </li>
                <li v-show="movie['overview']">
                    <span>Overview</span>
                    <span>{{ movie['overview'] }}</span>
                    <span v-if="movie['imdb_id']">
                        <a target="_blank" :href="'https://www.imdb.com/title/' +movie['imdb_id']">IMDb</a>
                    </span>
                </li>
            </ul>
        </template>
    </div>
    <b-spinner v-else class='spinner' style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
</template>

<script>
export default {
    props: {
        movieRoute: {
            type: String,
            required: true
        },
        posterPlaceholder: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            movie: '',
            loaded: false,
            error: false
        }
    },
    mounted() {
        this.fetchMovieById()
    },
    methods: {
        fetchMovieById() {
            axios.get(this.movieRoute).then(response => {
                this.movie = response.data
            }).catch((error) => {
                this.error = true
                console.log(error)
                this.loaded = true
            }).finally(
                setTimeout(
                    () => {
                        this.loaded = true
                    }, 500
                )
            )
        },
        extract(array) {
            let output = '';
            for (const property of array) {
                output += ', ' + property.name;
            }
            return output.substring(1);
        }
    }
}
</script>

<style scoped lang="scss">

.summary {
    height: 100%;
    display: flex;
    justify-content: space-between;
    padding: 3% 2%;

    img {
        height: 50%;
        flex: 1;
    }

    .characteristics {
        padding: 0;
        margin-left: 20px;
        flex: 4;

        li {
            display: flex;
            justify-content: space-between;
            font-size: 1.2em;
            border-bottom: 3px dotted black;
            padding-top: 5px;

            &:last-child {
                align-items: center;
                flex-direction: column;
                border-bottom: none;
            }
        }
    }
}
</style>
