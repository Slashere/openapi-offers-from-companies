
    <template>


        <Disclosure as="nav" class="bg-white" v-slot="{ open }">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Open main menu</span>
                            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                        </DisclosureButton>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <router-link class="inline-block" :to="{name : 'welcome'}">
                                <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow" />
                                <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
                            </router-link>
                        </div>
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex" style="margin:8px">
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user" class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'home' }">
                                        Личный кабинет
                                    </router-link>
                                </a>
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && userRoles[0].slug === 'company'"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'my-offers' }">
                                        Мои предложения
                                    </router-link>
                                </a>
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && userRoles[0].slug === 'company'"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'my-company' }">
                                        Моя компания
                                    </router-link>
                                </a>
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && userRoles[0].slug === 'admin'"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'companies' }">
                                        Компании
                                    </router-link>
                                </a>
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && (userRoles[0].slug === 'admin' || userRoles[0].slug === 'client')"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offers' }">
                                        Предложения
                                    </router-link>
                                </a>
                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && userRoles[0].slug === 'client'"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offers' }">
                                        Взятое предложение
                                    </router-link>
                                </a>

                                <a>
                                    <router-link active-class="font-semibold text-gray-900"
                                                 v-if="user && userRoles[0].slug === 'company'"
                                                 class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offer-activation' }">
                                        Активация предложения
                                    </router-link>
                                </a>


                                    <a  v-if="!user">
                                    <router-link class="p-4 tracking-widest flex items-center  text-gray-600"
                                                 active-class="font-semibold text-gray-800"
                                                 :to="{ name: 'login' }">
                                        Логин
                                    </router-link>
                                    </a>
                                    <a  v-if="!user">
                                    <router-link class="p-4 tracking-widest flex items-center  text-gray-600"
                                                 active-class="font-semibold text-gray-800"
                                                 :to="{ name: 'register' }">
                                        Регистрация
                                    </router-link>
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div  class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                        <!-- Profile dropdown -->
                        <Menu v-if="user" as="div" class="ml-3 relative">
                            <div>
                                <MenuButton class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://www.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png" alt="" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems  class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                        <a class="cursor-default" href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                            {{user.name}} (Роль: {{userRoles[0].name}})
                                        </a>
                                    </MenuItem>

                                    <MenuItem v-slot="{ active }">
                                        <router-link :to="{ name: 'settings' }">
                                        <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                            Настройки
                                            </a>
                                        </router-link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a  @click="logout" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Выйти</a>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <DisclosureButton as="a">
                        <router-link v-if="user"
                                     class="px-6 text-gray-500 hover:text-gray-900"
                                     :to="{ name: 'home' }">
                            Личный кабинет
                        </router-link>
                    </DisclosureButton>
                    <DisclosureButton as="a">
                        <router-link active-class="font-semibold text-gray-900"
                                     v-if="user && userRoles[0].slug === 'company'"
                                     class="px-6 text-gray-500 hover:text-gray-900" :to="{ name: 'my-offers' }">
                            Мои предложения
                        </router-link>
                    </DisclosureButton>
                    <DisclosureButton as="a">
                        <router-link active-class="font-semibold text-gray-900"
                                     v-if="user && userRoles[0].slug === 'company'"
                                     class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'my-company' }">
                            Моя компания
                        </router-link>
                    </DisclosureButton>
                    <DisclosureButton as="a">
                        <router-link active-class="font-semibold text-gray-900"
                                     v-if="user && userRoles[0].slug === 'admin'"
                                     class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'companies' }">
                            Компании
                        </router-link>
                    </DisclosureButton>
                    <DisclosureButton as="a"
                                      class="'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium"
                                      active-class="bg-gray-900 text-white">
                        <router-link v-if="user && (userRoles[0].slug === 'admin' || userRoles[0].slug === 'client')" :to="{ name: 'offers' }">
                            Предложения
                        </router-link>
                    </DisclosureButton>

                    <DisclosureButton as="a">
                        <router-link active-class="font-semibold text-gray-900"
                                     v-if="user && userRoles[0].slug === 'client'"
                                     class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offers' }">
                            Взятое предложение
                        </router-link>
                    </DisclosureButton>
                    <DisclosureButton as="a">
                        <router-link active-class="font-semibold text-gray-900"
                                     v-if="user && userRoles[0].slug === 'company'"
                                     class="px-6 text-gray-500 hover:text-gray-900 " :to="{ name: 'offers' }">
                            Активация предложения
                        </router-link>
                    </DisclosureButton>
                </div>
            </DisclosurePanel>
        </Disclosure>
    </template>

<script>
import { CogIcon , LogoutIcon , ChevronDownIcon } from '@heroicons/vue/outline';
import { LocationMarkerIcon  } from '@heroicons/vue/solid';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'


export default {
    created: function() {
        if(this.$store.getters.user) {
            let self = this ;
            window.addEventListener('click', function(e){
                if ( self.$refs.dropMenu && !self.$refs.dropMenu.contains(e.target) ){
                    self.drop = false
                }
            })
        }
    },

    components: {
        CogIcon,
        LogoutIcon,
        ChevronDownIcon,
        LocationMarkerIcon,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        BellIcon,
        MenuIcon,
        XIcon
    },
    data() {
        return {
            drop : false ,
            showNav : false ,
            navigation : [
                { name: 'Dashboard', href: '#', current: true },
                { name: 'Team', href: '#', current: false },
                { name: 'Projects', href: '#', current: false },
                { name: 'Calendar', href: '#', current: false },
            ]
        }
    },
    computed : {
        user() {
            return this.$store.getters.user ;
        },
        userRoles() {
            console.log(this.$store.getters.userRoles)
            return this.$store.getters.userRoles ;
        },
        userPermissions() {
            return this.$store.getters.userPermissions ;
        }
    },
    methods : {
        async logout() {
            await this.$store.dispatch('logout');
            this.$router.push({name : 'login'});
        },

    }
}
</script>
