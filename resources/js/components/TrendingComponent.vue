<template>
    <div class="carousel">
        <a :href="showRoute+'/'+movie['id']" class="item" v-for="(movie, index) in this.movies"
           :key="index"
           :style="{ backgroundImage: 'url(https://image.tmdb.org/t/p/w342/' + movie['poster_path'] + ')' }">
            <div class="item-title">{{ movie['original_title'] }}</div>
        </a>
    </div>
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
            start: 0,
            end: 3,
            movies: [],
        };
    },
    mounted() {
        this.fetchMovies();
    },
    methods: {
        fetchMovies() {
            axios.get(this.trendingUrl).then(response => {
                this.movieList = response.data.results;
                this.cutMovie();
                this.cutMovieInterval()
            }).catch((error) => {
                console.log(error)
            })
        },
        cutMovie() {
            this.movies = this.movieList.slice(this.start, this.end);
            if (this.movieList.length - 2 <= this.end) {
                this.start = 0;
                this.end = 3;
            } else {
                this.start += 3;
                this.end += 3;
            }
        },
        cutMovieInterval() {
            setInterval(() => {
                    this.cutMovie();
                }, 3000
            )
        }
    }
}
</script>

<style scoped>
.carousel {
    display: flex;
    align-content: center;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: 5% 0;
}

.item {
    width: 20%;
    height: 60vh;
    background-color: red;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.item-title {
    padding: 10px;
    font-size: 20px;
    color: white;
    text-shadow: -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;
}
</style>
