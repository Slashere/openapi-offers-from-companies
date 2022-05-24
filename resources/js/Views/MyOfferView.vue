<template>
    <div class="max-w-screen-lg mx-auto text-gray-900">
        <div class="flex justify-center">
            <div class="flex-1">
                <div class="border w-auto">
                    <div  class="border p-4 font-semibold ">Мое предложение</div>

                    <div class="p-4 bg-white">
                        <div v-if="loading">
                            <div style="border-top-color:transparent"
                                 class="w-16 h-16 border-4 border-blue-400 border-solid rounded-full animate-spin mx-auto"></div>
                        </div>
                        <div v-else-if="offer">
                            {{ offer.id }}
                            {{ offer.name }}
                            {{ offer.description }}
                        </div>

                        <p v-else>Error</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api';
import moment from 'moment';

export default {
    data() {
        return {
            loading: false,
            deleteId: null,
            searchKey: null,
            offer: [],
            model: {}
        };
    },
    async created() {
        await this.getOffer();
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
        async getOffer() {
            this.loading = true;
            console.log(123);
            this.offer = await api.getOffer(this.$route.params.id);
            this.loading = false;
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
