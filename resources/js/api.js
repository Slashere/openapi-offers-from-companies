import axios from 'axios';

const client = axios.create({
    baseURL: 'http://localhost/api',
    json: true
});

export default {
    async execute(method, resource, data) {
        return client({
            method,
            url: resource,
            data,
            headers: {}
        }).then((req) => {
            return req.data;
        })
    },
    //-------------------COMPANY---------------------
    createCompany(data) {
        return this.execute('post', '/company', data);
    },
    companyExists() {
        return this.execute('get', `/company/exists`);
    },
    deleteCompany(id) {
        return this.execute('delete', `/company/${id}`);
    },
    getCompany(id) {
        return this.execute('get', `/company/${id}`);
    },
    getCompanies() {
        return this.execute('get', '/company');
    },
    updateCompany(id, data) {
        return this.execute('put', `/company/${id}`, data);
    },
    //-------------------OFFER---------------------
    createOffer(data) {
        return this.execute('post', '/offer', data);
    },
    deleteOffer(id) {
        return this.execute('delete', `/offer/${id}`);
    },
    getOffer(id) {
        return this.execute('get', `/offer/${id}`);
    },
    getOffers() {
        return this.execute('get', '/offer');
    },
    getMyOffers() {
        return this.execute('get', '/offer/my');
    },
    updateOffer(id, data) {
        return this.execute('put', `/offer/${id}`, data);
    }
};
