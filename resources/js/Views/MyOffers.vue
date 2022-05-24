<template>
    <div class="max-w-screen-lg mx-auto text-gray-900">
        <div class="flex justify-center">
            <div class="flex-1">
                <div class="border w-auto">
                    <div  class="border p-4 font-semibold ">Мои предложения</div>

                    <div class="p-4 bg-white">
                        <Success  v-if="success" :content="success" @close="success=null" />

                        <Errors  v-if="errors" :content="errors" @close="errors=null" />

                        <div v-if="companyCreated">
                            <div v-if="loading">
                                <div style="border-top-color:transparent"
                                     class="w-16 h-16 border-4 border-blue-400 border-solid rounded-full animate-spin mx-auto"></div>
                            </div>

                            <table v-else-if="offers.length" class="table-auto">
                                <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Имя</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Описание</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Цена</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Скидка</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Запущено?</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Создано</th>
                                    <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="3">
                                        Действия</th>
                                </tr>
                                </thead>

                                <tbody class="bg-white">
                                <tr v-for="offer in offers" :key="offer.id">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            {{ offer.id }}
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ offer.name }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <p>{{ offer.description }}</p>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ offer.price }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ offer.sale_percent }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="form-check">
                                            <input class="form-check-input cursor-pointer"
                                                   @click.prevent="enableOffer(offer.id)" type="checkbox" id="flexCheckDefault" v-model="offer.enabled">
                                            {{offer.enabled}}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ offer.enabled }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <span>{{ offer.created_at }}</span>
                                    </td>

                                    <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                            Редактировать
                                        </a>
                                    </td>
                                    <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                        <router-link :to="{name : 'my-offer-view', params: { id: offer.id }}" class="p-4 flex items-center" active-class="text-white bg-blue-500">
                                            Смотреть
                                        </router-link>
                                    </td>
                                    <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                        <a href="#" @click.prevent="deleteOffer(offer.id)">
                                            <button size="sm" variant="danger">Удалить</button>
                                        </a>

                                    </td>

                                </tr>

                                </tbody>
                            </table>

                            <p v-else>Нет предложений</p>
                        </div>

                        <div class="flex items-center justify-center" v-else>
                            <p>У вас нет компании</p>
                            <router-link class="p-2 mr-4" :to="{ name: 'my-company' }">
                                <button type="submit" class="p-3 rounded-sm text-white bg-blue-500 hover:bg-blue-600">
                                    Создать компанию
                                </button>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api';
import moment from 'moment';

import Errors from '../components/Errors.vue';
import Success from '../components/Success.vue';

export default {
    data() {
        return {
            loading: false,
            deleteId: null,
            searchKey: null,
            companyCreated: true,
            errors : null,
            success : '' ,
            offers: [],
            model: {}
        };
    },
    components : {
        Errors,
        Success,
    },
    async created() {
        let exists = await this.companyExists();
        console.log(exists);
        if (exists) await this.refreshOffers();
    },
    computed: {
        filteredOffers: function () {
            const self = this;
            if (!self.searchKey) {
                return self.offers;
            }
            return self.offers.filter(function (offer) {
                return offer.subject.toLowerCase().indexOf(self.searchKey.toLowerCase()) !== -1;
            });
        }
    },
    methods: {
        formatDate(date) {
            if (date) {
                return moment(date).format('MMMM D YYYY, h:mm:ss a');
            } else {
                return '';
            }
        },
        async refreshOffers() {
            this.loading = true;
            this.offers = await api.getMyOffers();
            this.loading = false;
        },
        async companyExists() {
            this.loading = true;
            this.companyCreated = await api.companyExists();
            this.loading = false;
            return this.companyCreated
        },
        async populateOfferToEdit(offer) {
            // The Object.assign() call copies the value of the offer argument rather than the reference. When
            // dealing with mutation of objects in Vue, you should always set to the value, not reference.
            this.model = Object.assign({}, offer);
        },
        async saveOffer() {
            if (this.model.id) {
                await api.updateOffer(this.model.id, this.model);
            } else {
                await api.createOffer(this.model);
            }
            this.model = {}; // reset form
            await this.refreshOffers();
        },
        async onCancel() {
            this.model = {};
        },
        async deleteOffer(id) {
            if (id) {
                await api.deleteOffer(id);
                await this.refreshOffers();
            }
        },
        async enableOffer(id) {
            if (id) {
                try {
                    await api.updateOffer(id, {'enabled': true});
                }
                catch (e){
                    this.errors = e.data
                };
                await this.refreshOffers();
            }
        },
    }
};
</script>

<style>
thead {
    background-color: rgba(0, 0, 0, 0.09);
}
td {
    white-space: nowrap;
}
.table {
    outline: thin solid #ddd;
}
.app-container {
    margin-bottom: 1rem;
}
</style>
