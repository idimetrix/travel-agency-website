import {shuffle} from 'lodash'
export const proofs = {
    data() {
        return {
            i: -1,
            count: 0,
            random_array: []
        }
    },
    watch: {
        i(n) {
            if (n < this.count) {
                setTimeout(() => {
                    this.callInterval()
                }, 4000) // время задержки перед показом тоста
            }
        }
    },
    methods: {
        callInterval() {
            $(`#toast-${this.random_array[this.i]}`).addClass('active')
            setTimeout(() => {
                $(`#toast-${this.random_array[this.i]}`).removeClass('active')
                this.i++
            }, 10000) //время показа тоста

        }
    },
    mounted() {
        let toast = $('.toast')
        toast.each(function (index) {
                $(this).attr('id', 'toast-' + index)
            }
        )
        this.count = toast.length
        this.random_array = [...Array(this.count).keys()]
        this.random_array = shuffle(this.random_array)
        setTimeout(() => {
            this.i = 0
        }, 6000) //время до первого появления
    }
}
