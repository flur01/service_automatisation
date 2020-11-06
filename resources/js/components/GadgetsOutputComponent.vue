<template>
    <div class="gadjets-output">

            <div class="filter ">
                <div class="serial-search-input">
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Search</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg>
                        </div>
                    </div>

                    <input type="text"
                        class="form-control serial-search-input"
                        id="inlineFormInputGroupUsername2"
                        aria-describedby="button-addon2"
                        :placeholder="$t('Product Serial Number')"
                        name="filter"
                        ref="filter"
                        autocomplete="off"
                        @change="output();"
                        @input="output();  to_autocomplete();"
                        @focus="draw=true"
                        @blur="draw=false"
                    >

                    <div class="input-group-append">
                        <button @click="get_gadgets_data" class="btn btn-outline-secondary" id="button-addon2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-repeat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                    <transition name="autocomplete" mode="out-in">
                        <div class="autocomplete" v-if="autocomplete_data.length>0 && draw==true">

                            <transition-group name="autocomplete-block" mode="out-in"  tag="ul">
                                <li v-for="autocomplete_product in autocomplete_data" :key="autocomplete_product.id">
                                    <p @click="choose_autocomplete(autocomplete_product.product_number); draw=false">
                                        {{autocomplete_product.product_number}}
                                    </p>
                                </li>
                            </transition-group>

                            <span @click="draw=false">X</span>
                        </div>
                    </transition>
                </div>
            </div>

        <transition name="fade" mode="out-in">
            <table colspan="0" v-if="gadgetdata.length">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th v-if="is_admin == 1">{{ $t('Shop Name') }}</th>
                        <th>{{ $t('Product Name') }}</th>
                        <th>{{ $t('Product Serial Number') }}</th>
                        <th>{{ $t('Sale Date') }}</th>
                    </tr>
                </thead>
                <transition-group name="list" mode="out-in"  tag="tbody">
                    <tr v-for="gadget in pagination_data"  v-bind:key="gadget.id">
                        <template v-for="element in gadget">
                            <td v-bind:key="element" v-if="element">
                                {{ element }}
                            </td>
                        </template>
                    </tr>
                </transition-group>
            </table>

            <div class="error" v-if="gadgetdata.length != 0 || rendered == true" >
            <p>{{ $t('Data Not Found') }}</p>
            </div>

        </transition>
        <div class="mt-1" v-if="pagination_list['length']>1">
            <ul class="pagination">
                <li  class="page-item" v-bind:ref="'p'+idx" v-for="(page, idx) in pagination_list" v-bind:key="idx">
                    <a class="page-link" @click="slice_for_pagination(pagination_list[idx]); disable_element(idx)"  href="#">{{idx+1}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {

    data:function(){
        return{
            // gadgets data
            all_gadgets: [],
            gadgetdata: [],
            is_admin: false,
            rendered : false,
            // autocomplete data
            products: [],
            name: '',
            search_data: '',
            got_data: false,
            autocomplete_data: [],
            draw: false,
            //pagination data
            pagination_list: [],
            pagination_data: [],
            page_length: 10,
            prev_id: 0,
            set: true

        }
    },

    mounted() {
        this.get_gadgets_data();
    },

    updated(){
        if (this.set) {
            this.$refs["p0"][0].className = "page-item disabled TEST";
            this.set = false;
        }
    },

    methods:{

        get_gadgets_data: function(){
            axios.get('./get-json').then((response) => {
                this.pagination_list = [];
                this.all_gadgets = response.data.gadgets;
                this.gadgetdata = this.all_gadgets;
                this.is_admin = response.data.is_admin;
                this.rendered = true;
                this.make_pagination_list(this.page_length);
                this.slice_for_pagination(this.pagination_list[0]);
            });
        },

        output: function(search){
            let filter_data = this.$refs.filter.value;
            if(search!=undefined){
                filter_data = search;

            }

            this.got_data = true;

            if(filter_data){
                this.pagination_data = [];
                this.pagination_list = [];
                this.gadgetdata = [];
                let stop = false;
                this.all_gadgets.forEach(gadget => {
                    if (gadget.product_number.includes(filter_data)) {
                        this.gadgetdata.push(gadget);
                    }

                    if(!stop){
                        if(gadget.product_number == filter_data){
                            this.autocomplete_data = [];
                            stop = true;
                        }
                    }
                });
                this.make_pagination_list(this.page_length);
                this.slice_for_pagination(this.pagination_list[0]);
            }
            else{
                this.get_gadgets_data();
                this.name = '';
            }


        },

        to_autocomplete: function(){
            if(this.got_data){
                this.search_data = this.$refs.filter.value;
                const search_len = 7;

                if(this.search_data){
                    let count = 0;
                    let data = [];
                    this.all_gadgets.forEach(product => {
                        if(count<search_len){
                            if (product.product_number.includes(this.search_data)) {
                                data.push(product);
                                count++;
                            }
                        }
                    });
                    this.autocomplete_data = data;
                }
                else{
                    this.autocomplete_data = []
                }
            }
        },

        choose_autocomplete: function(serial_number){
            this.$refs.filter.value = serial_number;
            this.autocomplete_data = [];
            this.output(serial_number);
        },

        slice_for_pagination: function(page){
            this.pagination_data = this.gadgetdata.slice(page.start, page.end);
        },

        make_pagination_list: function(n){
            let len = this.gadgetdata['length'];
            let parts = Math.ceil(len/n);
            let start = 0;
            let end = n;
            for (let i = 0; i < parts; i++) {
                this.pagination_list.push({
                    'start':  start,
                    'end':  end
                    });
                start += n;
                end += n;
            }
        },

        disable_element: function(id){
            this.$refs["p"+this.prev_id][0].className = "page-item";
            this.$refs["p"+id][0].className = "page-item disabled";
            this.prev_id = id;
        }
    },

}
</script>
