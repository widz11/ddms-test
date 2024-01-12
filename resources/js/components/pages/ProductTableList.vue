<template>
    <div>
        <b-table show-empty :items="items" :fields="fields" :current-page="currentPage" :per-page="0"></b-table>
        <b-pagination size="md" :total-rows="totalItems" v-model="currentPage" :per-page="perPage"></b-pagination>
    </div>
</template>

<script>
import {
   BTable, BPagination
} from 'bootstrap-vue'

export default {
    components: {
        BTable,
        BPagination
    },
    data() {
        return {
            url: `http://localhost:8000/api/product`,
            items: [],
            fields: [
                { key: 'id', label: 'ID'},
                { key: 'name', label: 'Product Name'},
                { key: 'quantity', label: 'Quantity'},
                { key: 'price', label: 'Price'},
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
