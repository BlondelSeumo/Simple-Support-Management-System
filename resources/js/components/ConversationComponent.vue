  <template>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Who's Online?</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <div class="form-group">
                            <input type="text" v-model="searchChatUser" class="form-control" placeholder="Enter Chart User Name" >
                        </div>

                        <div class="form-group" v-if="!filterGetUsers.length" v-html="searchUserNotFoundMesesage"></div>

                        <li class="media" v-for="(user,index) in filterGetUsers" :key="index" v-if="(index < 5)">
                            <img alt="image" class="mr-3 rounded-circle" width="50" v-bind:src="user.image" />
                            <div class="media-body">
                                <div class="mt-0 mb-1 font-weight-bold"><a :class="{ 'text-primary': activeChatUser(user.id) }" :href="'/admin/conversation/' + user.id">{{ user.name }}</a></div>
                                <div class="text-muted text-small font-600-bold">{{ user.designation }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-8">
            <div class="card chat-box" id="chat-box" v-if="chatuserid">
                <div class="card-header">
                    <h4 v-html="chatWithToUser"></h4>
                </div>
                <div class="card-body chat-content" tabindex="2" style="overflow: auto; outline: none;" v-chat-scroll>
                    <div class="chat-item" v-for="(conversation,index) in conversations" :key="index" v-bind:class="[conversation.user.id !== authuser.id ? 'chat-left' : 'chat-right']">
                        <img v-bind:src="conversation.user.image" :title="conversation.user.name"/>
                        <div class="chat-details">
                            <div class="chat-text">{{ conversation.message }}  </div>
                            <div class="chat-time">{{ conversation.created_on }}</div>
                        </div>
                    </div>
                    <div class="chat-item chat-left chat-typing" v-if="messageTypingUser">
                        <img v-bind:src="messageTypingUser.image" />
                        <div class="chat-details">
                            <div class="chat-text"></div>
                            <div class="chat-time">{{ messageTypingUser.name }} is typing now</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer chat-form">
                    <div id="chat-form">
                        <input type="text" v-model="message" class="form-control" placeholder="Type a Conversation" @keyup.enter="sendConversation()"/>
                        <button class="btn btn-primary" v-on:click="sendConversation()">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card" v-else>
                <div class="card-body">
                    <strong>Please select a user to message</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['authuser', 'chatuser'],
        data() {
            return {
                searchChatUser: '',
                pusherUsers: [],
                getUsers: [],
                message: '',
                conversations: [],
                messageTypingUser:false,
                typingTimer:false,
            }
        },
        computed: {
            searchUserNotFoundMesesage: function() {
                if(this.searchChatUser === '') {
                    return "<b>This user not found</b>";
                }
                return "<b>This <span class='text-danger'>"+ this.searchChatUser +"</span> user not found.</b>";
            },

            chatWithToUser() {
                return "Chat With - " + (this.chatuser ? this.chatuser.name : '');
            },

            chatuserid() {
                return this.chatuser ? this.chatuser.id : 0;
            },

            chatuserchannel: function () {
              return this.chatuserid;
            },

            filterGetUsers() {
              return this.getUsers.filter(user => {
                return user.name.toLowerCase().includes(this.searchChatUser.toLowerCase())
              })
            },
        },
        mounted() {
            this.getUserList();

            this.getConversation();

            Echo.private('chat.' + this.chatuserchannel)
                .listen('ConversationSent',  (event) => {
                    this.conversations.push(event.message);
                })
                .listenForWhisper('typing', user => {

                    this.messageTypingUser = user;

                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }

                    this.typingTimer = setTimeout(()=> {
                        this.messageTypingUser = false;
                    }, 2000);

                });

            Echo.join('chat.' + this.chatuserchannel)
                .here(pusherUsers=> {
                    this.pusherUsers = pusherUsers;
                })
                .joining(user=> {
                    this.pusherUsers.push(user);
                })
                .leaving(user=> {
                    this.pusherUsers = this.pusherUsers.filter(u=> u.id !== user.id);
                });
        },
        methods: {

            activeChatUser(id) {
                return (id===this.chatuserid);
            },

            getUserList() {
                axios.get('/admin/get-user').then(response => {
                    this.getUsers = response.data;
                });
            },

            getConversation() {
                axios.get('/admin/get-conversation', {params: {'chat_user_id': this.chatuserid }}).then(response => {
                    this.conversations = response.data;
                });
            },

            sendConversation() {
                if(this.message !== '') {
                    axios.post('/admin/set-conversation', {'message': this.message, 'chat_user_id': this.chatuserid});
                    this.message = '';

                } else {
                    console.log('The message field is required.');
                }
            },
        },
        watch: {
            message() {
                Echo.private('chat.' + this.chatuserchannel)
                    .whisper('typing', this.authuser);
            }
        }
    }
</script>
