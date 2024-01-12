<template>
    <div>
        <b-table show-empty :items="items" :fields="fields" :current-page="currentPage" :per-page="0"></b-table>
        <b-pagination size="md" :total-rows="totalItems" v-model="currentPage" :per-page="perPage"></b-pagination>
    </div>
</template>

<script>
import {
   BTable, BPagination, BButton
} from 'bootstrap-vue'

export default {
    components: {
        BTable,
        BPagination
    },
    data() {
        return {
            url: `http://localhost:8000/api/invoice`,
            items: [],
            fields: [
                { key: 'id', label: 'ID'},
                { key: 'trx_id', label: 'Trx ID'},
                { key: 'amount_total', label: 'Amount Total'},
                { key: 'created_at', label: 'Date'},
            ],
            currentPage: 1,
            perPage: 10,
            totalItems: 0
        }
    },
    mounted() {
        this.fetchData().catch(error => {
            console.error(error)
        })
    },
    methods: {
        async fetchData() {
            let params = {
                is_paginate: true,
                page: this.currentPage,
                page_size: this.perPage
            }
            axios.get(this.url, {params})
                .then((response) => {
                    this.items = response.data.data
                    this.totalItems = parseInt(response.data.data.meta.total, 10)
                })
        }
    },
    watch: {
        currentPage: {
            handler: function(value) {
                this.fetchData().catch(error => {
                    console.error(error)
                })
            }
        }
    }
}
</script>
