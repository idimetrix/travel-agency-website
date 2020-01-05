<template>
    <div class="limiter" v-if="!userMeta.access_token" key="login">
        <div class="container-login100 img-backgroud" @keyup.enter="authAdmin">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <div class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title">
						Вход
					</span>
                    <div class="p-t-31 p-b-9">
						<span class="txt1 font-weight-bold">
							Логин
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" v-model="admin.username"
                               @focus="errorCleaner">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
						<span class="txt1 font-weight-bold">
							Пароль
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" v-model="admin.password"
                               @focus="errorCleaner">
                        <span class="focus-input100"></span>
                    </div>
                    <p v-if="error" class="error-message">{{error_message}}</p>
                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn" @click="authAdmin">
                            Войти
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else key="login" class="d-flex justify-content-center align-items-center loader-login">
        <clip-loader :color="'#80cbc4'"></clip-loader>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex';
    import ClipLoader from 'vue-spinner/src/ClipLoader'

    export default {
        components: {ClipLoader},
        data() {
            return {
                admin: {
                    username: '',
                    password: ''
                },
                error: false,
                error_message: ''
            }
        },
        methods: {
            authAdmin() {
                this.$axios.post('login', this.admin)
                    .then(res => {
                        if (res.data.data) {
                            this.$store.commit('setUser', res.data.data)
                            this.$store.commit('setLoginFail', false)
                            location.href = 'dashboard'
                        }
                    })
            },
            errorCleaner() {
                if (this.error) {
                    this.error = false
                }
            }
        },
        watch: {
            loginStatus(n) {
                if (n) {
                    this.error = true
                    this.error_message = 'Неверные имя пользователя и/или пароль'
                }
            }
        },
        computed: {
            ...mapGetters({
                userMeta: 'getUserMetaData',
                loginStatus: 'loginStatus'


            })
        },
        created() {
            if (this.userMeta.access_token) {
                location.href = 'dashboard'
            }
        }
    }
</script>
<style scoped lang="scss">
    @import "../../sass/css/main.css";
    @import "../../sass/css/util.css";

    .img-backgroud {
        background-image: url('~/images/bg-01.jpg');
    }

    .error-message {
        text-align: center;
        font-weight: bold;
        color: red;
        margin: 10px 0;
    }

    .loader-login {
        width: 100vw;
        height: 100vh;
    }
</style>