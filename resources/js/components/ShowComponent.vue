<template>
    <div v-if="loading" class="loader">
        <img class="spinner" :src="filmReel" :alt="translation.reel">
    </div>
    <div class="error" v-else-if="error">{{ translation.error }}</div>
    <div v-else class="movie-summary">
        <img v-if="movie.poster_path" :src="movie.poster_path">
        <img v-else :src="posterPlaceholder" :alt="translation.placeholder">
        <ul class="movie-descriptions">
            <li v-for="(detail, index) in movie" v-if="index !== 'poster_path'"
                :class="{'overview':index === 'overview'}">
                <span class="description-title">
                    {{ translation[index] }}
                </span>
                <span v-if="!Array.isArray(detail)">
                        <a v-if="typeof detail === 'string' && detail.startsWith('http')" target="_blank"
                           :href="detail">
                            {{ detail }}
                        </a>
                        <template v-else>
                            {{ detail + (index === 'runtime' ? ' min' : (index === 'budget' ? ' $' : '')) }}
                        </template>
                    </span>
                <span v-else>
                    {{ addSeparator(detail) }}
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        translation: {
            type: Object,
            required: true
        },
        movieRoute: {
            type: String,
            required: true
        },
        posterPlaceholder: {
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
            movie: '',
            loading: true,
            error: ''
        }
    },
    mounted() {
        this.fetchMovie()
    },
    methods: {
        fetchMovie() {
            axios.get(this.movieRoute).then(response => {
                this.movie = response.data
            }).catch((error) => {
                this.error = error.response
            }).finally(() => {
                this.loading = false
            })
        },
        addSeparator(array) {
            let output = '';
            for (const property of array) {
                output += ', ' + property;
            }

            return output.substring(1);
        }
    }
}
</script>
