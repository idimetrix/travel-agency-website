<template>
    <div class="col-lg-12 mb-4 mb-lg-5">
        <div v-if="fortune" class="zaq">
            <div class="text-center">
                <h3>Учавствуй в лотерее от Cronix Tour!</h3>
                <h6>И выиграй скидку на путешествие мечты!</h6>
            </div>
            <div class="mt-4 mt-sm-5 position-relative d-flex align-items-center flex-direction-col">
                <div id="arrow">
                    <svg viewBox="0 0 10 30" width="13">
                        <polygon points="5,0 10,10, 5,30, 0,10" fill="#b30505"></polygon>
                    </svg>
                </div>
                <div id="board">
                    <div class="stud" v-for="(prize, index) in prizes"
                         :style="{transform: 'rotate(' + ((index * radius) - (radius / 2)) + 'deg)'}"></div>
                    <div id="wheel">
                        <div class="piece" v-for="(prize, index) in prizes"
                             :style="{transform: 'rotate(' + index * radius + 'deg)'}">
                            <div class="bg">
                                <p>{{ prize }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button @click="spin" class="btn-blue" :disabled="state.spin">УЧАВСТВОВАТЬ!</button>
            </div>
        </div>
        <div v-else>
            <div class="confetti">
                <div class="confetti-piece" v-for="(i, key) in 13" :key="key+'confetti'"></div>
            </div>
            <form id="second-modal-form">
                <div class="title-form-wrap">
                    <div class="mb-3 cup">
                        <img src="../../images/cup.svg" class="tada animated-tada" alt="">
                    </div>
                    <h3>
                        Поздравляем!
                        <br>Ваша скидка составит: {{form.discount}}
                    </h3>
                    <h6 class="text-center">Вы также можете подарить скидку другу!</h6>
                    <div class="line"></div>
                </div>
                <div class="fields-block align-items-center">
                    <input autocomplete="off" required class="name-input-field" type="text" name="name"
                           v-model="form.name"
                           placeholder="Ваше имя/Имя друга"/>
                    <input autocomplete="off" required class="number-input-field" type="text" name="phone"
                           v-model="form.email"
                           placeholder="Телефон/Email"/>
                    <button  type="button" :class="{'disabled': !form.name || !form.email }"
                            class="btn-blue submit-button mt-2" @click="sentForm">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import TwinMax from 'gsap/TweenMax'
    import axios from 'axios'
    import $ from 'jquery'
    import moment from 'moment'

    export default {
        name: "FortuneWheel",
        components: {
            TwinMax
        },
        data() {
            return {
                prizes: [
                    '1%',
                    '500₽',
                    '2%',
                    '1000₽',
                    '3%',
                    '1500₽',
                    '1%',
                    '500₽',
                    '2%',
                    '1000₽',
                    '3%',
                    '1500₽',
                ],
                radius: 0,
                max: 0,
                state: {
                    spin: false
                },
                fortune: true,
                form: {
                    email: null,
                    name: null,
                    discount: null,
                }
            }
        },
        watch: {
            'state.spin'(n) {
                if (!n) {
                    setTimeout(() => {
                        this.fortune = n
                    }, 2000)
                }
            }
        },
        mounted() {
            this.max = this.prizes.length
            this.radius = 360 / this.prizes.length
        },
        methods: {

            sentForm() {
                axios.post('/wheel-of-fortune', this.form)
                    .then(() => {
                        $('.fortune-modal .close').trigger('click')
                    })
                    .catch(err => {
                        console.error(err)
                    })
                    .finally(() => {
                        Object.keys(this.form).forEach(el => {
                            this.form[el] = null
                        })
                    })
            },
            spin() {
                if (this.state.spin) {
                    return
                }

                let index = Math.floor(Math.random() * this.max)
                let rotations = 360 * ((Math.ceil(Math.random() * 1)) + 5) + ((index) / this.max * 360) + (Math.floor(Math.random() * (360 / this.max)))
                // let rotations = ((index - 1) / this.max * 360)
                let seconds = 3
                this.form.discount = this.prizes[index];
                this.state.spin = true

                new TweenMax.fromTo('#board', seconds, {
                    rotation: 0
                }, {
                    rotation: -(rotations),
                    ease: Sine.easeOut,
                    onComplete: this.done
                })
                ym(49191817, 'reachGoal', 'wheel_of_fortune_use');
            },

            done() {
                this.state.spin = false
            }
        },
        // created() {
        //     // console.log('seen befo', seen)
        //     let seen = localStorage.getItem('seen')
        //     seen = moment(seen).add(30, 'seconds')
        //     console.log(seen, 'qwerty')
        // }
    }
</script>

<style scoped lang="scss">
    .btn-blue {
        background: #2196F3;
        border-radius: 10px;
        height: 55px;
        min-width: 255px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-family: "Montserrat-Bold", sans-serif;
        font-style: normal;
        line-height: normal;
        font-size: 12px;
        letter-spacing: 0.05em;
        color: #ffffff;
        border: none;
        text-transform: uppercase;
        -moz-transition: all .45s ease-in-out;
        -webkit-transition: all .45s ease-in-out;
        -o-transition: all .45s ease-in-out;
        -ms-transition: all .45s ease-in-out;
        transition: all .45s ease-in-out;

        &:hover {
            background: #155F7F;
            color: #ffffff;
            text-decoration: none;
        }

    }

    #arrow {
        position: absolute;
        top: -20px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
        z-index: 1;
    }

    #board {
        position: relative;
        width: 350px;
        height: 350px;
        background-color: #656A69;
        padding: 13px;
        border-radius: 50%;
    }

    #board .stud {
        width: 0;
        height: 100%;
        position: absolute;
        top: 0;
        left: 50%;
        z-index: 0;
    }

    #board .stud::after {
        content: "";
        display: block;
        width: 8px;
        height: 8px;
        position: absolute;
        top: 2px;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }

    #wheel {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #ffffff;
        overflow: hidden;
    }

    #wheel .piece {
        top: 0;
        left: 50%;
        position: absolute;
        width: 50%;
        height: 100%;
        overflow: hidden;
        -webkit-transform-origin: left center;
        transform-origin: left center;
    }

    #wheel .piece:nth-child(3n+1) .bg {
        background-color: #FB9703;
    }

    #wheel .piece:nth-child(3n+2) .bg {
        background-color: #2db29f;
    }

    #wheel .piece:nth-child(3n+3) .bg {
        background-color: #2196F3;
    }

    #wheel .piece .bg {
        -webkit-transform: rotate(30deg);
        transform: rotate(30deg);
        position: absolute;
        left: -100%;
        width: 100%;
        height: 100%;
        content: "";
        -webkit-transform-origin: right center;
        transform-origin: right center;
    }

    #wheel p {
        height: auto;
        position: absolute;
        top: 30px;
        left: 30%;
        z-index: 0;
        margin: 0;
        line-height: 1em;
        font-size: 17px;
        font-weight: bold;
        color: white;
        -webkit-transform: rotate(69deg);
        transform: rotate(75deg);
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    button {
        padding: 20px 30px;
        display: block;
        margin: 50px auto 0 auto;
        cursor: pointer;
        border: 0;
        background-color: red;
        color: #fff;
        font-size: 2em;
        border-radius: 10px;
    }

    button:disabled {
        background-color: #888888;
    }

    @media (max-width: 576px) {
        #board {
            width: 280px;
            height: 280px
        }
    }
</style>
