<template>
    <div>

        <transition name="product" mode="in-out">
            <label v-if="name" for="name">{{ $t('Product Name') }}</label>
        </transition>
        <transition name="product" mode="out-in">
            <p v-if="name" class="product-name">{{name}}</p>
        </transition>
        <div  class="serial-search-input">
            <label for="name">{{ $t('Product Serial Number') }}</label>
            <input
                autocomplete="off"
                name="number" type="text" ref="serial_input"
                @change="show()"
                @input="show(); to_autocomplete();"
                @focus="draw=true"
                @blur="draw=false">
            <transition name="autocomplete" mode="out-in">
            <div class="autocomplete" v-if="autocomplete_data.length>0 && draw==true" >

                <transition-group name="autocomplete-block" tag="ul">
                    <li v-for="autocomplete_product in autocomplete_data" :key="autocomplete_product.serial_number">
                        <p @click="choose_autocomplete(autocomplete_product.serial_number); draw=false">
                            {{autocomplete_product.serial_number}}
                        </p>
                    </li>
                </transition-group>

                <span @click="draw=false">X</span>
            </div>
            </transition>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    data:function(){
        return{
            products: [],
            name: '',
            search_data: '',
            got_data: false,
            autocomplete_data: [],
            draw: false
        }
    },

    mounted() {
        this.get_products_data();
    },

    methods:{

        get_products_data: function(){
            axios.get('./add-form/get-json').then((response) => {
                this.products = response.data;
            });
        },

        show:  function(){
            let search_data = this.$refs.serial_input.value;

            if(search_data){
                let stop = false;
                this.got_data = true;
                this.products.forEach(product => {
                    if(!stop){
                        this.name = '';
                        if(product.serial_number == search_data){
                            let len = Math.floor(product.name.length/2);
                            this.name = product.name.slice(0, len)+' ...';
                            this.autocomplete_data = [];
                            stop = true;
                        }
                    }
                });
            }
            else{
                this.name = '';
            }

        },

        to_autocomplete: function(){
            if(this.got_data){
                this.search_data = this.$refs.serial_input.value;
                const search_len = 4;

                if(this.search_data != ''){
                    let count = 0;
                    let data = [];
                    this.products.forEach(product => {
                        if(count<search_len){
                            if (product.serial_number.includes(this.search_data)) {
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
            this.$refs.serial_input.value = serial_number;
            this.autocomplete_data = [];
            this.show();
        }
    },
}
</script>
