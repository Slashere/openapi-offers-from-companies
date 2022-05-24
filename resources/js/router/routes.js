const Settings = () => import('../Views/Settings.vue');
const Profile = () => import('../Views/Profile.vue');
const Password = () => import('../Views/Password.vue');
const Login = () => import('../Views/Login.vue');
const ForgotPassword = () => import('../Views/ForgotPassword.vue');
const ResetPassword = () => import('../Views/ResetPassword.vue');
const VerifyEmail = () => import('../Views/VerifyEmail.vue');
const Register = () => import('../Views/Register.vue');
const Home = () => import('../Views/Home.vue');
const APIMethods = () => import('../Views/APIMethods.vue');
const NotFound = () => import('../Views/NotFound.vue');
const Welcome = () => import('../Views/Welcome.vue');
const Companies = () => import('../Views/Companies.vue')
const MyCompany = () => import('../Views/MyCompany.vue')
const Offers = () => import('../Views/Offers.vue')
const MyOffers = () => import('../Views/MyOffers.vue')
const MyOfferView  = () => import('../Views/MyOfferView.vue')
const PostsManager = () => import('../Views/PostsManager.vue')
const OfferActivation = () => import('../Views/OfferActivation.vue')

export default [{
        path: '/',
        component: Welcome,
        name: 'welcome',
    },
    {
        path: '/api-methods',
        component: APIMethods,
        name: 'api-methods',
    },
    {
        path: '/companies',
        component: Companies,
        name: 'companies',
        meta: {
            guard: 'auth'
        }
    },
    {
        path: '/posts-manager',
        name: 'PostsManager',
        component: PostsManager,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/my-company',
        component: MyCompany,
        name: 'my-company',
        meta: {
            guard: 'auth'
        }
    },
    {
        path: '/offers',
        component: Offers,
        name: 'offers',
        meta: {
            guard: 'auth'
        }
    },
    {
        path: '/my-offers',
        component: MyOffers,
        name: 'my-offers',
        meta: {
            guard: 'auth'
        },

    },
    {
        path: '/offer-activation',
        component: OfferActivation,
        name: 'offer-activation',
        meta: {
            guard: 'auth'
        },

    },
    {
        path: '/my-offers/:id',
        component: MyOfferView,
        name: 'my-offer-view',
        meta: {
            guard: 'auth'
        }},
    {
        path: '/home',
        component: Home,
        name: 'home',
        meta: {
            guard: 'auth'
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/forgot-password',
        component: ForgotPassword,
        name: 'forgot-password',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/reset-password/:token',
        props: route => ({
            token: route.params.token,
            email: route.query.email
        }),
        component: ResetPassword,
        name: 'reset-password',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/verify-email/:id/:hash',
        props: route => ({
            id: route.params.id,
            hash: route.params.hash
        }),
        component: VerifyEmail,
        name: 'verify-email',

    },
    {
        path: '/settings',
        component: Settings,
        redirect: {
            name: 'profile'
        },
        name: 'settings',
        meta: {
            guard: 'auth'
        },
        children: [{
                path: 'profile',
                component: Profile,
                name: 'profile',
                meta: {
                    guard: 'auth'
                },

            },
            {
                path: 'password',
                component: Password,
                name: 'password',
                meta: {
                    guard: 'auth'
                },

            },

        ]
    },
    {
        path: "/:catchAll(.*)",
        component: NotFound,
    },
];
