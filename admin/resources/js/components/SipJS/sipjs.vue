<template>
    <div class="card">
        <div class="card-header">

            <i v-if="!registered" @click="register()" :class="'fas fa-fw fa-phone-alt text-' + (registered ? 'success' : 'danger')"></i>
            <i v-if="registered" @click="unregister()" :class="'fas fa-fw fa-phone-alt text-' + (registered ? 'success' : 'danger')"></i>
            <span @click="pickupCall()">&nbsp; {{ UserConfig.userAgentOptions.displayName }} </span>

            <div class="card-tools">
                <input @keyup.enter="call($event)" type="text" class="form-control form-control-sm" placeholder="number + (enter)">
            </div>
        </div>

        <div class="card-body" v-if="onCall">
            <div class="row bg-primary text-center">
                <div class="col-12">
                    {{ sessionNum }}
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-2 text-center">
                    <i @click="parkCall()" class="fas fa-parking"></i>
                </div>
                <div class="col-2 text-center">
                    <i v-if="!muted" @click="muteCall()" class="fas fa-microphone text-success"></i>
                    <i v-if="muted" @click="unmuteCall()" class="fas fa-microphone-slash text-danger"></i>
                </div>
                <div class="col-2 text-center">
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <br>
                    <table class="table text-center table-bordered">
                        <tr>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="1" class="btn btn-block btn-outline-primary btn-xs">1</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="2" class="btn btn-block btn-outline-primary btn-xs">2</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="3" class="btn btn-block btn-outline-primary btn-xs">3</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="4" class="btn btn-block btn-outline-primary btn-xs">4</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="5" class="btn btn-block btn-outline-primary btn-xs">5</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="6" class="btn btn-block btn-outline-primary btn-xs">6</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="7" class="btn btn-block btn-outline-primary btn-xs">7</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="8" class="btn btn-block btn-outline-primary btn-xs">8</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="9" class="btn btn-block btn-outline-primary btn-xs">9</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="*" class="btn btn-block btn-outline-primary btn-xs">*</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="0" class="btn btn-block btn-outline-primary btn-xs">0</button>
                            </td>
                            <td>
                                <button type="button" @click="sendDTMF($event)" value="#" class="btn btn-block btn-outline-primary btn-xs">#</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-3"></div>
            </div>
        </div>

        <div v-show="btnAtender || btnRejeitar || btnDesligar" class="card-footer">
            <div class="row">
                <div class="col-6">
                    <button v-if="btnAtender" type="button" @click="answerCall()" class="btn btn-block bg-gradient-success btn-xs">Atender</button>
                </div>
                <div class="col-6">
                    <button v-if="btnRejeitar" type="button" @click="declineCall()" class="btn btn-block bg-gradient-warning btn-xs">Rejeitar</button>
                </div>
                <div class="col-12">
                    <button v-if="btnDesligar" type="button" @click="hangupCall()" class="btn btn-block bg-gradient-danger btn-xs">Desligar</button>
                </div>
            </div>
        </div>

        <audio style="display: none;" :id="AudioElementId" controls>
            <p>Your browser doesn't support HTML5 audio.</p>
        </audio>
    </div>
</template>

<script>

    import { Web } from "sip.js";

    export default {

        data: function(){
            return {
                AudioElement: null,
                AudioElementId: "htmlaudio",

                server: "wss://webrtc01.mxipcall.com.br/ws",

                UserConfig: {

                    aor: "sip:C1-7779@atenas.mxsolucoes.com.br:5060",

                    userAgentOptions: {

                        authorizationUsername: 'C1-7779',
                        authorizationPassword: 'MXIPCALL!izcVEPkn93',

                        contactName: "C1-7779",
                        displayName: "C1-7779",

                        userAgentString: "MxIpCall Web",
                        viaHost: "webrtc01.mxipcall.com.br",
                    },
                    
                    media: {
                        remote: {}
                    }
                },

                SimpleUser: null,

                btnAtender: false,
                btnRejeitar: false,
                btnDesligar: false,

                onCall: false,
                sessionNum: null,
                muted: false,

                registered: false
            }
        },

        components: { 
            Web
        },

        async mounted() {

            this.getAudioElement();
            this.UserConfig.media.remote.audio = this.AudioElement;

            this.SimpleUser = new Web.SimpleUser(this.server, this.UserConfig);

            this.SimpleUser.delegate = {
                onCallReceived: async () => {
                    console.warn("Chamada Recebida!");
                    // console.warn(this.SimpleUser);

                    this.handleAutoAnswer();

                    this.receivedCall();
                },

                onCallHangup: async () => {
                    console.warn("Chamada Desligada!");
                    // console.warn(this.SimpleUser);

                    this.endendCall()
                },

                onCallAnswered: async () => {
                    console.warn("Chamada Atendida!");
                    // console.warn(this.SimpleUser);

                    this.answeredCall();
                },

                onCallCreated: async () => {
                    console.warn("Chamada Criada!");
                    // console.warn(this.SimpleUser);

                    this.createdCall();
                },

                onRegistered: async () => {
                    console.warn("Conta Registrada!");
                    
                    this.$store.commit('setTrue');
                    this.registered = true;
                },

                onUnregistered: async () => {
                    console.warn("Conta Desregistrada!");

                    this.$store.commit('setFalse');
                    this.registered = false;
                },

                onServerConnect: async () => {
                    console.warn("Websocket Conectado!");
                },

                onServerDisconnect: async (error) => {
                    console.warn("Websocket Desconectado: " + error + "!");
                }
            }

            await this.SimpleUser.connect();
            await this.SimpleUser.register();

            // await this.SimpleUser.call("sip:043991620341@atenas.mxsolucoes.com.br");

            setInterval(() => {
                
                this.handleOnlineCall();

                this.muted = this.SimpleUser.isMuted();

                console.warn("isMuted: " + this.muted);

            }, 1000)
        }, 

        methods: {
            
            getAudioElement: function(){

                const el = document.getElementById(this.AudioElementId);

                if(!(el instanceof HTMLAudioElement)){

                    throw new Error(`Elemento ${this.AudioElementId} não encontrado ou não é um elemento de áudio!`)
                }

                this.AudioElement = el;
            },

            sendDTMF: function(e){

                let number = e.target.value;

                this.SimpleUser.sendDTMF(number)
            },

            call: function(e){

                let number = e.target.value;
                let toCall = "sip:" + number + "@atenas.mxsolucoes.com.br:5060";

                this.sessionNum = toCall;

                this.SimpleUser.call(toCall);
            },

            register: function(){

                this.SimpleUser.register();
            },

            unregister: function(){

                this.SimpleUser.unregister();
            },
            
            hangupCall: function(){

                this.SimpleUser.hangup();
            },

            answerCall: function(){

                this.SimpleUser.answer();
            },

            declineCall: function(){
                
                this.SimpleUser.decline();
            },

            answeredCall: function(){
                this.btnDesligar = true;
                this.btnAtender = false;
                this.btnRejeitar = false;

                this.onCall = true;
            },

            rejectedCall: function(){
                this.btnDesligar = false;
                this.btnAtender = false;
                this.btnRejeitar = false;

                this.sessionNum = false;

                this.onCall = false;
            },

            endendCall: function(){
                this.btnDesligar = false;
                this.btnAtender = false;
                this.btnRejeitar = false;

                this.sessionNum = false;

                this.onCall = false;
            },

            createdCall: function(){
                this.btnDesligar = true;
                this.btnAtender = false;
                this.btnRejeitar = false;

                this.onCall = true;
            },

            receivedCall: function(){
                this.btnDesligar = false;
                this.btnAtender = true;
                this.btnRejeitar = true;

                this.sessionNum = 
                    this.SimpleUser.session._dialog.dialogState.remoteTarget.normal.scheme + ":" +
                    this.SimpleUser.session._dialog.dialogState.remoteTarget.normal.user + "@" +
                    this.SimpleUser.session._dialog.dialogState.remoteTarget.normal.host + ":" +
                    this.SimpleUser.session._dialog.dialogState.remoteTarget.normal.port;

                this.onCall = true;
            },

            muteCall: function(){

                this.SimpleUser.mute();
            },

            unmuteCall: function(){

                this.SimpleUser.unmute();
            },

            parkCall: function(){

                this.SimpleUser.sendDTMF("#");

                this.forceDelay(100).then(() => {
                    this.SimpleUser.sendDTMF("8")
                });
            },

            pickupCall: function(){

                let toCall = "sip:" + "*7" + "@atenas.mxsolucoes.com.br:5060";

                this.sessionNum = toCall;

                this.SimpleUser.call(toCall);
            },

            forceDelay: function(waitTime){
                return new Promise((resolve) => {
                    setTimeout(resolve, waitTime);
                });å
            },

            handleAutoAnswer: function(){

                let callInfoHeader = this.SimpleUser.session.incomingInviteRequest.message.headers['Call-Info'];
                let autoAnswer;

                if(callInfoHeader){

                    callInfoHeader.map((header) => {

                        if(header.raw){

                            let itens = header.raw;
                            itens = itens.split(';');

                            itens.map((item) => {

                                if((item.split('='))[0] == 'answer-after'){

                                    autoAnswer = {
                                        autoanswer: true,
                                        timer: (item.split('='))[1]
                                    }
                                }
                            });
                        }
                    });

                }

                if(autoAnswer && autoAnswer.autoanswer){
                    this.answerCall()
                }
            },

            handleOnlineCall: function(){

                // console.warn("Session? " + (this.SimpleUser.session ? "SIIM" : "Ainda Não!"));
                // console.warn(this.SimpleUser.session);
            }
        }
    }
</script>
