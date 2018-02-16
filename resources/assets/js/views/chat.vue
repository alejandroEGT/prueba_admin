<template>
	
	<div>
		<div class="box-chat" >
			<div class="chat-body" v-chat-scroll >
         <chat-messages :messages="messages"></chat-messages >
         <hr>
			</div>
    
     <div class="chat-foot">           
         <chat-form v-on:messagesent="addMessage" :user="nameAuth" :load="btn_load"></chat-form>
      </div>
		</div>
	</div>
</template>

<script type="text/javascript">
  
   import { getUserAuth } from '../endpoints';
  export default{
   
    data(){
      return{
          btn_load: false,
          nameAuth: '',
          messages:[],
          id_projecto: this.$route.params.id,
          newMessage: '',
      }
    },
    created(){
      this.getNameUser();
      this.fetchMessages();
     
    },
    methods:{
       getNameUser() {
                getUserAuth().then((response) =>{
                      this.nameAuth = response.data;
                      this.loading = false;
                      Echo.private('chatProyecto.'+this.nameAuth.id).listen('MessageProyecto', (e) => {
                      this.fetchMessages();
                      var audio = new Audio('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
                      audio.play();
                        /*this.messages.push({
                          message: e.message.message,
                          user: e.user
                        });*/
                      });
                }).catch((error) =>{
                        console.log("error");
                });
        },
        sendMessage() {
                this.$emit('messagesent', {
                    nameAuth: this.nameAuth,
                    message: this.newMessage
                });

                this.newMessage = ''
        },
        fetchMessages() {
            axios.get('frontend/messages/'+this.id_projecto).then(response => {
                this.messages = response.data;
                console.log(response.data);
            });
        },

        addMessage(message) {
            //this.messages.push(message);
            this.btn_load = true;
            var datos={}
            datos.message = message;
            datos.id_proyecto = this.id_projecto;

            axios.post('frontend/messages', datos).then(response => {
              this.btn_load = false;
              this.fetchMessages();
            });
        }
    },
  }

</script>


<style type="text/css">
	.box-chat{
		position: relative;
		height: 500px;
		width: 100%;
		border-radius: 5px;
		border: 1px solid #B2BABB;
	}
	.chat-body{

		height: 450px;
		width: 100%;
		overflow: auto;
	}
	.chat-foot{
		  position: absolute;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  padding: 1rem;
		  text-align: center;
		  background: #ECF0F1;
	}

</style>

