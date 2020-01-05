import Cookie from 'js-cookie'

export default {
    setUser(state, user) {
        Cookie.set('cronix-tour-extended', user, {
            secure: process.env.NODE_ENV === 'production',
            expire: Number(user.expires_in) / 86400
        })
        state.user = user
    },
    removeUserData(state) {
        Cookie.remove('cronix-tour-extended')
        state.user = {}
    },
    setLoginFail(state, data) {
        state.loginFail = data
    },
    setAnswer(state, answer) {
        let error_array = []
        for (let prop in answer) {
            if (answer.hasOwnProperty(prop)) {
                error_array = [...error_array, ...answer[prop]]
            }
        }
        state.answer = error_array
    }
}