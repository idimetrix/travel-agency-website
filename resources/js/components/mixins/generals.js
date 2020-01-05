import moment from 'moment'

moment.locale('ru')
export const generals = {
    methods: {
        humanityTimeView(back_format) {
            return back_format ? moment(back_format).format('LL') : ''
        },
        limiterImagesCounterToRequire(data, leng) {
            return data.length <= leng ? data : data.slice(0, leng)
        }
    }
}