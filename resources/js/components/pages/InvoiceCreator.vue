<template>
    <div>
        <h3>Items</h3>
        <div class="row align-items-center">
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-4">
                <b-card
                    no-body
                    style="max-width: 20rem;"
                >
                    <template #header>
                        <h4 class="mb-0">Summary</h4>
                    </template>

                    <b-list-group flush>
                        <b-list-group-item>Total item: {{ totalItems }} </b-list-group-item>
                        <b-list-group-item>Total amount: {{ totalAmount }} </b-list-group-item>
                    </b-list-group>

                    <b-card-body>
                        <b-button variant="primary" @click.prevent="submit()">Submit</b-button>
                    </b-card-body>
                </b-card>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-2" v-if="totalItems > 0">Product</div>
            <div class="col-2" v-if="totalItems > 0">Quantity</div>
            <div class="col-2" v-if="totalItems > 0">Price</div>
            <div class="col-2"></div>
            <div class="col-4"></div>
        </div>
        <div style="margin-bottom:5px" class="row align-items-center" v-for="(value, key) in items" :key="key">
            <div class="col-2">
                <b-form-select
                    class="form-control"
                    v-model="items[key].product_id"
                    :options="products"
                    :key="`product-${key}`"
                >
                    <template #first>
                        <b-form-select-option :value="null" disabled>-- Please select product --</b-form-select-option>
                    </template>
                </b-form-select>
            </div>
            <div class="col-2">
                <b-form-input :id="`quantity-${key}`" type="number" v-model="items[key].quantity"></b-form-input>
            </div>
            <div class="col-2">
                <b-form-input :id="`price-${key}`" type="number" v-model="items[key].price"></b-form-input>
            </div>
            <div class="col-2">
                <b-button variant="danger" @click.prevent="deleteItem(key)"><span class="mdi mdi-delete"></span> Delete Item</b-button>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
        <b-button variant="outline-primary" @click.prevent="addItem"><span class="mdi mdi-plus"></span> Add Item</b-button>
    </div>
</template>

<script>
import {
    BFormInput, BButton, BFormSelect, BFormSelectOption, BCard, BCardBody, BListGroup, BListGroupItem
} from 'bootstrap-vue'

export default {
    components: {
        BFormInput,
        BFormSelect,
        BFormSelectOption,
        BButton,
        BCard,
        BCardBody, 
        BListGroup, 
        BListGroupItem
    },
    data() {
        return {
            totalItems: 0,
            totalAmount: 0,
            items: [],
            orderCount: 1,
            products: [
                {value: 1, text: "Product 1"},
                {value: 2, text: "Product 2"}
            ]
        };
    },
    methods: {
        addItem() {
            this.totalItems += 1;
            this.items.push({
                product_id: 0,
                quantity: 0,
                price: 0
            })
        },
        deleteItem(index) {
            this.totalItems -= 1;
            this.items.splice(index-1, 1)
        },
        fetchProducts() {
            const url = `http://localhost:8000/api/product`
            let params = {
                is_paginate: false
            }
            axios.get(url, {params})
                .then((response) => {
                    if (Array.isArray(response.data.data)) {
                        this.products = []
                        for (let value of response.data.data) {
                            this.products.push({value: value.id, text: value.name })
                        } 
                    }
                })
        },
        submit() {
            const url = `http://localhost:8000/api/invoice`
            const products = []
            if (this.items.length <= 0) {
                alert("Empty item")
                return
            }
            for (let item of this.items) {
                products.push({
                    product_id: item.product_id,
                    quantity: item.quantity,
                    price: item.price
                })
            }
            axios.post(url, {
                    products: products
                })
                .then((response) => {
                    alert("Success")
                    this.items = []
                    this.totalItems = 0
                })
        }
    },
    mounted() {
        this.fetchProducts()
    },
    watch: {
        items: {
            handler(newVal, oldVal){  // here having access to the new and old value
                this.totalAmount = 0
                for (let item of this.items) {
                    if (item.quantity == "") {
                        item.quantity = 0   
                    }
                    if (item.price == "") {
                        item.price = 0   
                    }
                    this.totalAmount = this.totalAmount + parseFloat(item.quantity) * parseFloat(item.price)
                }
            },
            deep: true,
            immediate: true 
        }
    }
}
</script>
