<template>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <button type="submit" name="submit" :form="form_name" style="width: 100px;" class="btn btn-outline-primary btn-sm"><i class="fas fa-search"></i> Buscar</button>&nbsp;
                    <div class="btn-group">
                        <button type="button" style="width: 100px;" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Novo</button>
                        <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item disabled" href="#"><i class="far fa-file"></i>&nbsp; Importar do Arquivo</a>
                            <a class="dropdown-item disabled" href="#"><i class="fas fa-external-link-alt"></i>&nbsp; Importar da API</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <span v-show="!showBody" @click="ShowBody()" ><i class="fas fa-chevron-down float-right"></i></span>
                    <span v-show="showBody" @click="ShowBody()" ><i class="fas fa-chevron-up float-right"></i></span>
                </div>
            </div>
        </div>
        <div v-show="showBody" class="card-body">
            <slot name="card-body"></slot>
        </div>
    </div>
</div>

</template>

<script>
    export default {

        props: ['form_name'],

        data: function(){
            return {
                showBody: false
            }
        },

        mounted() {
            
        },

        methods: {

            ShowBody: function(){

                this.showBody = !this.showBody;
            }
        }
    }
</script>