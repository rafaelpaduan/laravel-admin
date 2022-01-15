<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div style="max-height: 300px; overflow-y: scroll;" ref="messagesContainer" class="card-body">
                        <p v-for="(message, index) in messages"><small style="color: red;">{{index}}</small>  {{message.text}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data: function(){
            return {
                messages: []
            }
        },

        mounted() {
            
            setInterval(() => {

                this.messages.push({
                    text: Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 120)
                })

                this.$nextTick(() => this.scrollToEnd());

                // console.log()

            }, 100)
        }, 

        methods: {
            scrollToEnd: function(){

                var content = this.$refs.messagesContainer;
                content.scrollTop = content.scrollHeight
            }
        },
    }
</script>
