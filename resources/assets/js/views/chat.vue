<template>
	
	<div>
		
		<div class="box-chat" >
			<div class="chat-body" >
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
      
        <ul class="chat">
          <li class="left clearfix" v-for="message in messages">
              <div class="chat-body clearfix">
                  <div class="header">
                      <strong class="primary-font">
                          {{ message.user.name }}
                      </strong>
                  </div>
                  <p>
                      {{ message.message }}
                  </p>
              </div>
          </li>
      </ul>

         
			</div>

			<div class="chat-foot" >

				<el-row>
				  <el-col :span="15">
				  		<el-input placeholder="Nuevo mensaje" ></el-input>
				  </el-col>
				  <el-col :span="2">
				  		<!--<el-button type="primary" icon="fa fa-paper-plane-o"  round>Enviar</el-button>-->
              <div class="input-group">
                  <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

                  <span class="input-group-btn">
                      <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                          Send
                      </button>
                  </span>
              </div>
            
				  </el-col>
				</el-row>	
			</div>
		</div>

	</div>

</template>

<script type="text/javascript">
  
   import { getUserAuth } from '../endpoints';
  export default{
    props: ['messages'],
    props: ['user'],
    data(){
      return{
          nameAuth: '',
          messages:'',
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

<style scoped lang="scss" >
	

@import url(http://weloveiconfonts.com/api/?family=typicons);
[class*="typicons-"]:before {
  font-family: 'Typicons', sans-serif;
}

.module {
  height: 500px;
  width: 100%;
  
}

.top-bar {
  background: #666;
  color: white;
  padding: 0.5rem;
  position: relative;
  overflow: hidden;
  h1 {
    display: inline;
    font-size: 1.1rem;
  }
  .typicons-message {
    display: inline-block;
    padding: 4px 5px 2px 5px;
  }
  .typicons-minus {
    position: relative;
    top: 3px;
  }
  .left {
    float: left;
  }
  .right {
    float: right;
    padding-top: 5px;
  }
  > * {
    position: relative; 
  }
  &::before {
    content: "";
    position: absolute;
    top: -100%;
    left: 0;
    right: 0;
    bottom: -100%;
    opacity: 0.25;
    background: radial-gradient(white, black);
    animation: pulse 1s ease alternate infinite;
  }
}

.discussion {
  list-style: none;
  /*background: #e5e5e5;*/
  margin: 0;
  padding: 0 0 50px 0; // finality
  li {
    padding: 0.5rem;
    overflow: hidden;
    display: flex;
  }
  .avatar {
    width: 40px; // stronger than %
    // could set height, but gonna bottom-align instead
    position: relative; // for triangle
    img {
      display: block; // triangle position
      width: 100%;
      border-radius:40%;
    }
  }
}

.other {
  .avatar {
    &:after {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      width: 0;
      height: 0;
      border: 5px solid #00A2F8;
      border-left-color: transparent;
      border-bottom-color: transparent;
    }
  }
}

.self {
  justify-content: flex-end;
  align-items: flex-end;
  .messages {
    order: 1;
    border-bottom-right-radius: 0; // weird shadow fix
  }
  .avatar {
    order: 2;
    &:after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 0;
      border: 5px solid #00A2F8;
      border-right-color: transparent;
      border-top-color: transparent;
      box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
    }
  }
}

.messages {
  
  width:300px;
  color:white;
  background: #00A2F8;
  padding: 10px;
  border-radius: 1px;
  box-shadow: 0 1px 2px rgba(black, 0.2);
  p {
    font-size: 0.9rem;
    margin: 0 0 0.2rem 0;
  }
  time {
    font-size: 0.7rem;
    color: #34495E;
  }
}

@keyframes pulse {
  from { opacity: 0; }
  to { opacity: 0.5; }
}
</style>