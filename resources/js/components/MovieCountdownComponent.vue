<template>
    <div v-if="!isMobile" class="countdown">
        <div class="divider"
             :style="[partition===n ?{background: gradient}: null, partition>n ? {background: '#D5D1D1'}: null]"
             v-for="n in 4">
        </div>
        <div class="counter">{{ this.message[this.partition - 1] }}</div>
    </div>
    <div v-else class="mobile-404">
        <img class="clapper" :src="clapperRoute" alt="Clapper">
        <div class="message">404 NOT FOUND</div>
    </div>
</template>

<script>
export default {
    props: {
        clapperRoute: String
    },
    data() {
        return {
            timer: 1,
            gradient: '',
            interval: null,
            partition: 1,
            deg: 0,
            message: [4, 0, 4, 'Not Found'],
            isMobile: ''
        }
    },
    created() {
        this.checkMobile();
        this.mobileListener();
        if (!this.isMobile) {
            this.addGradient('start');
        }
    },
    methods: {
        addGradient(phase) {
            if (phase === 'start' && this.interval === null) {
                this.interval = setInterval(() => {
                    this.timer++;
                    this.deg += 0.89
                    if (this.timer >= 99) {
                        this.timer = 0
                        this.deg = 90 * this.partition - 1;
                        if (this.partition >= 4) {
                            this.partition = 0
                        }
                        this.partition++;
                    }
                    this.gradient = "linear-gradient(" + this.deg + "deg, #D5D1D1 0% " + this.timer + "%, red " + (this.timer) + '%' + (this.timer + 0.6) + "%, #fff " + (this.timer) + "% 100%)";

                }, 1);
            } else if (phase === 'stop') {
                clearInterval(this.interval)
                this.interval = null;
            }
        },
        mobileListener() {
            window.addEventListener('resize', () => {
                this.checkMobile();
                if (!this.isMobile) {
                    this.addGradient('start');
                } else {
                    this.addGradient('stop');
                }
            });
        },
        checkMobile() {
            this.windowWidth = window.innerWidth
            this.isMobile = this.windowWidth <= 768;
        }
    },
}
</script>

<style scoped lang="scss">
@import "node_modules/bootstrap/scss/functions";
@import "node_modules/bootstrap/scss/variables";
@import "node_modules/bootstrap/scss/mixins/_breakpoints";

.countdown {
    position: relative;
    height: 100%;
    width: 90vh;
    display: flex;
    flex-wrap: wrap;

    .divider {
        border: 1px solid black;
        height: 45vh;
        width: 50%;
        box-sizing: border-box;
        background-color: #fff;

        &:nth-child(3) {
            order: 4;
        }
    }

    .counter {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 3em;
        height: 35vh;
        width: 35vh;
        border: 1px solid black;
        border-radius: 300px;
        background-color: #fff;
        top: 29%;
        left: 31%;
        z-index: 999;
    }
}

.mobile-404 {
    text-align: center;

    .message {
        margin-top: 10px;
    }

    .clapper {
        height: 80px;
    }
}

</style>
