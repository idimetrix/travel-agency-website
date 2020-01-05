<template>
    <v-app id="inspire">
        <v-snackbar
                top
                v-model="snackbar"
                :color="color"
                auto-height
                :multi-line="mode === 'multi-line'"
                :timeout="timeout"
                :vertical="mode === 'vertical'">
            <div class="d-flex flex-column w-100">
                <p class="text-center" v-for="(a, index) in answer" :key="index+'snake'">{{a}}</p>
            </div>
        </v-snackbar>
        <v-toolbar
                absolute
                color="teal lighten-3"
                dark
                scroll-off-screen
                scroll-target="#scrolling-techniques">
            <v-toolbar-side-icon @click="aside = !aside"></v-toolbar-side-icon>
            <v-toolbar-title>Admin</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-icon class="btn" @click="logout">
                exit_to_app
            </v-icon>
        </v-toolbar>
        <v-layout wrap style="height: 100%">
            <v-navigation-drawer
                    app
                    absolute
                    class="teal lighten-2"
                    dark
                    v-model="aside"
                    style="height: calc(100% - 64px); margin-top: 64px">
                <v-list>
                    <v-list-tile
                            class="aside-list"
                            :class="{'aside-active': dynamic === item.slug}"
                            v-for="item in navigation"
                            :key="item.title"
                            @click="dynamic = item.slug">
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>
            <v-card class="main-component-controller"
                    :class="[{'container-with-side': aside}, {'container-without-side': !aside}]">
                <dynamic-component :is="dynamic"></dynamic-component>
            </v-card>
        </v-layout>
    </v-app>
</template>
<script>
    import HotTours from './views/HotTours'
    import BlogComponent from './views/BlogComponent'
    import CommentsData from './views/Reviews'
    import WaysList from './views/WaysList'
    import CountriesList from './views/CountriesList'
    import {mapGetters} from 'vuex'

    export default {
        components: {
            HotTours, BlogComponent, CommentsData, WaysList, CountriesList
        },
        data() {
            return {
                snackbar: false,
                color: 'red',
                mode: '',
                timeout: 5000,
                aside: true,
                navigation: [
                    {title: 'Туры', icon: 'flight_takeoff', slug: 'HotTours'},
                    {title: 'Блог', icon: 'bookmarks', slug: 'BlogComponent'},
                    {title: 'Отзывы', icon: 'comment', slug: 'CommentsData'},
                    {title: 'Направления', icon: 'subway', slug: 'WaysList'},
                    {title: 'Страны', icon: 'format_list_bulleted', slug: 'CountriesList'},
                ],
                dynamic: '',
            }
        },
        computed: {
            ...mapGetters({
                answer: 'getAnswer'
            })
        },
        watch: {
            answer(n) {
                if (n.length) {
                    this.snackbar = true
                }
            },
            snackbar(n) {
                if (!n) {
                    this.$store.commit('setAnswer', '')
                }
            }
        },
        created() {
            this.dynamic = localStorage.getItem('last_admin_creator') ? localStorage.getItem('last_admin_creator') : 'HotTours'
        },
        methods: {
            logout() {
                this.$store.commit('removeUserData');
                location.href = 'login'
            }
        }
    }
</script>
<style lang="scss">
    @import "../../sass/admin-styles/admin-panel";
</style>