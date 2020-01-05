<template>
    <universal-articles :clarify_type="'country'"></universal-articles>
</template>
<script>
    import UniversalArticles from './universalArticles'

    export default {
        components: {UniversalArticles},
        slug: 'CountriesList',
        created() {
            let place = localStorage.getItem('last_admin_creator')
            if (place !== this.$options.slug) {
                localStorage.setItem('last_admin_creator', this.$options.slug)
            }
        }
    }
</script>