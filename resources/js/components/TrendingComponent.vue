<template>
    <div v-if="loaded" class="carousel">
        <a @click.prevent="changePage(-3)" class="navigation"><i class="fas fa-angle-left"></i></a>
        <a :href="showRoute+'/'+movie['id']" class="item" v-for="movie in this.movies"
           :style="{ backgroundImage: 'url(https://image.tmdb.org/t/p/w342/' + movie['poster_path'] + ')' }">
            <div class="item-title">{{ movie['original_title'] }}</div>
        </a>
        <a @click.prevent="changePage(3)" class="navigation"><i class="fas fa-angle-right"></i></a>
    </div>
    <b-spinner v-else class='spinner' style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner>
</template>

<script>
export default {
    props: {
        trendingUrl: {
            type: String,
            required: true
        },
        showRoute: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            movieList: '',
            start: -3,
            end: 0,
            movies: [],
            loaded: false,
            interval: null
        };
    },
    mounted() {
        this.fetchMovies();
    },
    methods: {
        fetchMovies() {
            axios.get(this.trendingUrl).then(response => {
                this.movieList = response.data.results;
                this.changePage(3)
            }).catch((error) => {
                console.log(error)
            }).finally(
                setTimeout(
                    () => {
                        this.loaded = true
                    }, 200
                )
            )
        },
        cutMovieList(step) {
            this.start += step;
            this.end += step;
            if (this.movieList.length - 2 < this.end) {
                this.start = 0;
                this.end = 3;
            }
            if (this.start < 0) {
                this.start = this.movieList.length - 2 + this.start;
                this.end = this.movieList.length - 2 + this.end;
            }
            this.movies = this.movieList.slice(this.start, this.end);
        },
        cutMovieListInterval() {
            clearInterval(this.interval);
            this.interval = setInterval(() => {
                    this.cutMovieList(3);
                }, 3000
            )
        },
        changePage(step) {
            this.cutMovieList(step)
            this.cutMovieListInterval();
        }
    }
}
</script>

<style scoped lang="scss">
.carousel {
    display: flex;
    align-content: center;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: 5% 0;

    .navigation {
        display: flex;
        align-items: center;
        font-size: 3rem;

        &:hover {
            text-decoration: none;
            cursor: pointer
        }
    }

    .item {
        width: 20%;
        height: 60vh;
        transition: 0.3s;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-end;
        justify-content: center;

        .item-title {
            padding: 10px;
            font-size: 20px;
            color: white;
            text-shadow: -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
        }
    }
}
</style>
