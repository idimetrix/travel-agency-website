export default {
    getUserMetaData: (state) => {
        return state.user;
    },
    loginStatus: state => {
        return state.loginFail
    },
    getAnswer(state) {
        return state.answer
    }
}