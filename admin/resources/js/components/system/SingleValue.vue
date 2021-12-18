<template>
    <span>{{ value }}</span>
</template>

<script>
    export default {

        props: ['endpoint', 'interval'],

        data: function(){
            return {
                value: 0
            }
        },

        mounted() {

            this.updateData();

            setInterval(() => {
                
                this.updateData();
            }, this.interval);            
        }, 

        methods: {

            updateData: async function(){

                let response = await axios.get(this.endpoint);
                this.value = response.data;
            }
        }
    }
</script>
