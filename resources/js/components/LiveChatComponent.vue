  <template>
    <div class="row">
        <div class="col-sm-9 col-lg-8 offset-sm-2">
            <div class="card chat-box" id="chat-box">
                <div class="card-header">
                    <h4 class="mb-0">{{ chatwith }} - <b class="text-primary">{{ chatuser ? chatuser.name : '' }}</b></h4>
                </div>
                <div class="card-body chat-content" tabindex="2" style="overflow: auto" v-chat-scroll>
                    <div class="chat-item" v-for="(conversation,index) in conversations" :key="index" v-bind:class="[conversation.user.id != user.id ? 'chat-left' : 'chat-right']">
                        <img v-bind:src="conversation.user.image" />
                        <div class="chat-details">
                            <div class="chat-text">{{ conversation.message }}  </div>
                            <div class="chat-time">{{ conversation.created_on }}</div>
                        </div>
                    </div>
                    <div class="chat-item chat-left chat-typing" v-if="activeUser">
                        <div class="chat-details">
                            <div class="chat-text"></div>
                            <div class="chat-time">{{ activeUser.name }} is typing now</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer chat-form">
                    <div id="chat-form">
                        <input type="text" v-model="conversation" class="form-control" placeholder="Type a conversation" @keyup.enter="sendConversation()"/>
                        <button class="btn btn-primary" v-on:click="sendConversation()">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user', 'chatuser'],
        data() {
            return {
                users: [],
                conversation: '',
                conversations: [],
                activeUser:false,
                typingTimer:false,
                chatwith:'Chat with',
            }
        },
        computed: {

            myuser: function () {
              return this.user;
            },

            chatuserchannel: function () {
              return this.user.id;
            }

        },
        mounted() {
            this.getConversation();

            Echo.private('chat.' + this.chatuserchannel)
                .listen('ConversationSent',  (event) => {
                    this.conversations.push(event.message);
                })
                .listenForWhisper('typing', user => {

                    this.activeUser = user;

                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }

                    this.typingTimer = setTimeout(()=> {
                        this.activeUser = false;
                    }, 2000);

                });

            Echo.join('chat.' + this.chatuserchannel)
                .here(users=> {
                    this.users = users;
                })
                .joining(user=> {
                    this.users.push(user);
                })
                .leaving(user=> {
                    this.users = this.users.filter(u=> u.id != user.id);
                });

        },
        methods: {

            getConversation() {
                axios.get('/get-livechat', {params: {'chatuserid': this.chatuserid }}).then(response => {
                    this.conversations = response.data;
                });
            },

            sendConversation() {
                if(this.conversation != '') {
                    axios.post('/set-livechat', {'conversation': this.conversation, 'chatuserid': this.chatuserid});
                    this.conversation = '';
                } else {
                    console.log('The message field is required.');
                }
            },
        },
        watch: {
            conversation() {
                Echo.private('chat.' + this.chatuserchannel)
                    .whisper('typing', this.user);
            }
        }
    }
</script>
