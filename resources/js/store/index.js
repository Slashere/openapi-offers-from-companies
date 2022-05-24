import axios from 'axios';
import { createStore } from 'vuex'
import sharedMutations from 'vuex-shared-mutations';


export default createStore({
    state() {
        return {
            user: null,
            count: 0,
            userRoles: null,
            userPermissions: null,
            todos: [
                { id: 1, text: 'Collect packages', done: false },
                { id: 2, text: 'Workout', done: false },
                { id: 3, text: 'Read one chapter', done: false },
                { id: 4, text: 'Buy socks', done: true }
            ],
            companies: null,
            myCompany: null,
            offers: null,
            myOffers: null,
        }
    },
    getters: {
        user(state) {
            return state.user;
        },
        userRoles(state) {
            return state.userRoles;
        },
        userPermissions(state) {
            return state.userPermissions;
        },
        verified(state) {
            if (state.user) return state.user.email_verified_at
            return null
        },
        id(state) {
            if (state.user) return state.user.id
            return null
        },
        companies(state) {
            return state.companies;
        },
        myCompany(state) {
            return state.myCompany;
        },
        offers(state) {
            return state.offers;
        },
        myOffers(state) {
            return state.myOffers;
        },
        thisTodo: state => todoId => {
            return state.todos.find(todo => todo?.id === todoId);
        },
        doneTodos: state => {
            return state.todos.filter(todo => todo.done);
        },
        doneTodosCount: (state, getters) => {
            return getters.doneTodos.length;
        },
        activeTodos: state => {
            return state.todos.filter(todo => !todo.done);
        },
        activeTodosCount: (state, getters) => {
            return getters.activeTodos.length;
        }
    },
    mutations: {

        setUser(state, payload) {
            state.user = payload
        },
        setUserRoles(state, payload) {
            state.userRoles = payload
        },
        setUserPermissions(state, payload) {
            state.userPermissions = payload
        },
        setCompanies(state, payload) {
            state.companies = payload;
        },
        setMyCompany(state, payload) {
            state.myCompany = payload;
        },
        setOffers(state, payload) {
            state.offers = payload;
        },
        setMyOffer(state, payload) {
            state.myOffer = payload;
        },

        increment: state => state.count++,
        decrement: state => state.count--,
        missionCompleted: function(state, todoId) {
            let todo = this.getters.thisTodo(todoId);
            todo.done = !todo.done;
        },
        addTodo: function(state, todoText) {
            console.log(todoText);
            let todoID = state.todos.slice(-1)[0]?.id;
            state.todos.push({
                id: todoID ? todoID + 1 : 0,
                text: todoText,
                done: false
            });
            console.log(state.todos);
        },
        deleteTodo: function(state, todoId) {
            let todoIndex = state.todos.indexOf(
                this.getters.thisTodo(todoId)
            );

            state.todos.splice(todoIndex, 1);

            delete state.todos[todoIndex];

        }

    },

    actions: {

        async login({ dispatch }, payload) {
            try {
                await axios.get('/sanctum/csrf-cookie');

                await axios.post('/api/login', payload).then((res) => {
                    dispatch('getUserRoles');
                    dispatch('getUserPermissions');
                    return dispatch('getUser');
                }).catch((err) => {
                    throw err.response
                });
                // const res = await axios.post('/api/login', payload);

                // if (res.status != 200) throw res;

                // if (res.data.status_code != 200) throw res.data.message;



            } catch (e) {
                throw e
            }

        },

        async register({ dispatch }, payload) {
            try {

                await axios.post('/api/register' , payload).then((res) => {
                    return dispatch('login' , { 'email' : payload.email , 'password' : payload.password})
                }).catch((err) => {
                    throw(err.response)
                })
            } catch (e) {
                throw (e)
            }
        },
        async logout({ commit }) {
                await axios.post('/api/logout').then((res) => {
                    commit('setUser', null);
                }).catch((err) => {

                })

        },
        async getUser({commit}) {
            await axios.get('/api/user').then((res) => {
                commit('setUser', res.data);
            }).catch((err) => {
                throw err.response
            })
        },
        async getUserRoles({commit}) {
            await axios.get('/api/user/roles').then((res) => {
                commit('setUserRoles', res.data);
            }).catch((err) => {
                throw err.response
            })
        },
        async getUserPermissions({commit}) {
            await axios.get('/api/user/permissions').then((res) => {
                commit('setUserPermissions', res.data);
            }).catch((err) => {
                throw err.response
            })
        },
        async getCompanies({commit}) {
            await axios.get('/api/companies').then((res) => {
                commit('setCompanies', res.data);
                // commit('setUserPermissions', res.data.permissions);
            }).catch((err) => {
                throw err.response
            })
        },
        async getMyCompany({commit}) {
            await axios.get('/api/my-company').then((res) => {
                commit('setMyCompany', res.data);
                // commit('setUserPermissions', res.data.permissions);
            }).catch((err) => {
                throw err.response
            })
        },
        async getOffers({commit}) {
            await axios.get('/api/offers').then((res) => {
                commit('setOffers', res.data);
                // commit('setUserPermissions', res.data.permissions);
            }).catch((err) => {
                throw err.response
            })
        },
        async getMyOffer({commit}) {
            await axios.get('/api/my-offer').then((res) => {
                commit('setMyOffer', res.data);
                // commit('setUserPermissions', res.data.permissions);
            }).catch((err) => {
                throw err.response
            })
        },

        async profile({commit},payload) {
            await axios.patch('/api/profile', payload).then((res) => {
                commit('setUser', res.data.user);
            }).catch((err) => {
                throw err.response
            })
        },
        async password({commit},payload) {
            await axios.patch('/api/password', payload).then((res) => {

            }).catch((err) => {
                throw err.response
            })
        },

        async verifyResend({dispatch} , payload){
            let res = await axios.post('/api/verify-resend' , payload)
            if (res.status != 200) throw res
            return res
        },
        async verifyEmail({dispatch} , payload){
            let res = await axios.post('/api/verify-email/' + payload.id + '/' + payload.hash)
            if (res.status != 200) throw res
            dispatch('getUserRoles')
            dispatch('getUserPermissions')
            dispatch('getUser')
                return res

        }

    },
    plugins: [sharedMutations({ predicate: ['setUser', 'setUserPermissions', 'setUserRoles'] })],


})
