<template>
    <div v-if="loading" class="loader">
        <img class="spinner" :src="filmReel" :alt="translation.reel">
    </div>
    <span v-else-if="error" class="error">{{ translation.error }}</span>
    <div v-else class="custom-container trending-carousel">
        <h1 class="trending-title">{{ translation.trending }}</h1>
        <a @click.prevent="changePage(-3)" class="navigation">
            <i class="fas fa-angle-left"></i>
        </a>
        <a :href="showRoute + '/' + movie.id" class="movie" v-for="movie in this.movies"
           :style="{ backgroundImage: 'url(https://image.tmdb.org/t/p/w342/' + movie.poster_path + ')'}"
           :alt="movie.original_title">
            <div class="movie-title">{{ movie.original_title }}</div>
        </a>
        <a @click.prevent="changePage(3)" class="navigation">
            <i class="fas fa-angle-right"></i>
        </a>
    </div>
</template>

<script>
export default {
    props: {
        translation: {
            type: Object,
            required: true
        },
        trendingUrl: {
            type: String,
            required: true
        },
        showRoute: {
            type: String,
            required: true
        },
        filmReel: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            movieList: '',
            start: 0,
            end: 3,
            movies: [],
            loading: true,
            carouseInterval: null,
            error: ''
        };
    },
    mounted() {
        this.fetchMovies();
    },
    methods: {
        fetchMovies() {
            axios.get(this.trendingUrl).then(response => {
                this.movieList = response.data.results;
                this.changePage(0)
            }).catch((error) => {
                this.error = error
            }).finally(() => {
                    this.loading = false
                }
            )
        },
        cutMovieList(step) {
            if (!Number.isInteger(step)) {
                return false;
            }

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
            clearInterval(this.carouseInterval);
            this.carouseInterval = setInterval(() => {
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
