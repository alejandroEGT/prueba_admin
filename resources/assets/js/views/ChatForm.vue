<template>
    <div class="">
        <el-row>
            <el-col :span="10" >
                <el-input placeholder="Escribir mensaje" name="message" v-model="newMessage" @keyup.enter="sendMessage"></el-input>
            </el-col>
            <el-col :span="5" >
                <el-button @click="sendMessage" v-loading="load">
                Enviar
            </el-button>
            </el-col>
        </el-row>
        <!--<input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">-->

        
        
    </div>
</template>

<script>
    export default {
        props: ['user', 'load'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>