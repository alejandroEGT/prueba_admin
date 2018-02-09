<template>
	
	<div>
		
		<div class="box-chat" >
			<div class="chat-body" v-chat-scroll >
				<!--<section class="module">
          <ol class="discussion">
            <li class="other">
              <div class="avatar">
                <img src="https://qph.ec.quoracdn.net/main-qimg-76b1a9a47d43e3792bd1ae5a9b2394d8" />
              </div>
              <div class="messages">
                <p>yeah, they do early flights cause they connect with big airports.  they wanna get u to your connection
        			
                </p>
                <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
              </div>
            </li>
            <li class="self">
              <div class="avatar">
                <img src="http://sm.ign.com/ign_es/screenshot/default/goku-0_19cy.jpg" />
              </div>
              <div class="messages">
                <p>That makes sense.</p>
                <p>It's a pretty small airport.</p>
                <time datetime="2009-11-13T20:14">37 mins</time>
              </div>
            </li>
            <li class="other">
              <div class="avatar">
                <img src="https://qph.ec.quoracdn.net/main-qimg-76b1a9a47d43e3792bd1ae5a9b2394d8" />
              </div>
              <div class="messages">
                <p>that mongodb thing looks good, huh?</p>
                <p>
                  tiny master db, and huge document store</p>
              </div>
            </li>
            <li class="self">
              <div class="avatar">
                <img src="http://sm.ign.com/ign_es/screenshot/default/goku-0_19cy.jpg" />
              </div>
              <div class="messages">
                <p>That makes sense.</p>
                <p>It's a pretty small airport.</p>
                <time datetime="2009-11-13T20:14">37 mins</time>
              </div>
            </li>
            <li class="other">
              <div class="avatar">
                <img src="https://qph.ec.quoracdn.net/main-qimg-76b1a9a47d43e3792bd1ae5a9b2394d8" />
              </div>
              <div class="messages">
                <p>that mongodb thing looks good, huh?</p>
                <p>
                  tiny master db, and huge document store</p>
              </div>
            </li>
            <li class="self">
              <div class="avatar">
                <img src="http://sm.ign.com/ign_es/screenshot/default/goku-0_19cy.jpg" />
              </div>
              <div class="messages">
                <p>That makes sense.</p>
                <p>It's a pretty small airport.</p>
                <time datetime="2009-11-13T20:14">37 mins</time>
              </div>
            </li>
            <li class="other">
              <div class="avatar">
                <img src="https://qph.ec.quoracdn.net/main-qimg-76b1a9a47d43e3792bd1ae5a9b2394d8" />
              </div>
              <div class="messages">
                <p>that mongodb thing looks good, huh?</p>
                <p>
                  tiny master db, and huge document store</p>
              </div>
            </li>
          </ol>
          
        </section>-->

         <chat-messages :messages="messages"></chat-messages >
         <hr>
			</div>
    
     <div class="chat-foot">           
         <chat-form v-on:messagesent="addMessage" :user="nameAuth"></chat-form>
      </div>

				
	
		</div>

	</div>

</template>

<script type="text/javascript">
  
   import { getUserAuth } from '../endpoints';
  export default{
   
    data(){
      return{
          nameAuth: '',
          messages:[],
          newMessage: '',
      }
    },
    created(){
      this.getNameUser();
      this.fetchMessages();

      Echo.private('chat').listen('MessageSent', (e) => {

         // alert("a llegado alerta de chat");
         var audio = new Audio('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
        audio.play();
          this.messages.push({
            message: e.message.message,
            user: e.user
          });
        });
     
    },
    methods:{
       getNameUser() {
                getUserAuth().then((response) =>{
                        console.log(response);
                        this.nameAuth = response.data;
                        this.loading = false;
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
            axios.get('frontend/messages').then(response => {
                this.messages = response.data;
                console.log(response.data);
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('frontend/messages', message).then(response => {
              console.log(response.data);
            });
        }
    }
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

