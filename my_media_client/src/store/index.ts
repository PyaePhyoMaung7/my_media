import {createStore} from 'vuex'

const store = createStore({
    state:{
        userData: {},
        token: '',
        
    },
    getters:{
        storedToken: state => state.token,
        storedUserData: state => state.userData,
        postViews: state => state.views,
    },
    mutations:{

    },
    actions:{
        setToken: ({state},value) => state.token = value,
        setUserData: ({state},value) =>state.userData = value,
    },
    modules:{

    }
})

export default store