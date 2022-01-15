<template>
    <div class="card">
        <div class="card-header">

            <h3 class="card-title" v-if="rg"><span :class="'right badge badge-' + ( rg.state == 'Registered' ? 'success' : 'danger' )">{{ rg.state }}</span></h3>

            <div class="card-tools">
                <button v-if="rg && rg.state != 'Registered'" type="button" @click="registerUserAgent()" class="btn btn-block bg-gradient-success btn-xs">Register</button>
                <button v-if="rg && rg.state == 'Registered'" type="button" @click="unregisterUserAgent()" class="btn btn-block bg-gradient-danger btn-xs">unRegister</button>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <!-- <input @keyup.enter="makeCall($event)" type="text" id="callInput" class="form-control" placeholder="number + (enter)"> -->
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <!-- <div class="col-6" v-if="outgoing">
                    <pre>{{ outgoing }}</pre>
                </div> -->
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <button type="button" @click="acceptCall()" class="btn btn-block bg-gradient-success btn-xs">Atender</button>
                </div>
                <div class="col-6">
                    <button type="button" @click="rejectCall()" class="btn btn-block bg-gradient-danger btn-xs">Rejeitar</button>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-6">
                    <button type="button" @click="cancelCall()" class="btn btn-block bg-gradient-danger btn-xs">Cancelar</button>
                </div>
                <div class="col-6">
                    <button type="button" @click="hangupCall()" class="btn btn-block bg-gradient-danger btn-xs">Desligar</button>
                </div>
            </div>
        </div>

        <audio style="display: none;" :id="AudioElementId" controls>
            <p>Your browser doesn't support HTML5 audio.</p>
        </audio>
    </div>
</template>

<script>

    import { UserAgent, Registerer, Inviter, SessionState } from "sip.js";
    // import { config } from "./config";

    export default {

        data: function(){
            return {

                AudioElementId: "remoteAudio",
                AudioElement: null,

                ua: null,
                rg: null,

                incoming: null,
                outgoing: null,
                session: null,

                wsConn: false,
                
                remoteStream: null,

                UserAgentOptions: {
                    aor: "sip:C1-7779@atenas.mxsolucoes.com.br:5060",
                    authorizationUsername: 'C1-7779',
                    authorizationPassword: 'MXIPCALL!izcVEPkn93',

                    contactName: "C1-7779",
                    displayName: "C1-7779",

                    userAgentString: "MxIpCall Web",
                    viaHost: "webrtc01.mxipcall.com.br",

                    transportOptions: {
                        server: "wss://webrtc01.mxipcall.com.br/ws"
                    },

                    RegistererOptions: {
                        logConfiguration: true
                    },

                    allowLegacyNotifications: true,

                    logConfiguration: true,

                    reconnectionAttempts: 10,

                    uri: null,

                    delegate: {},
                },

                SipJSOptions: {
                    autoregister: true
                },
            }
        },

        components: {

            UserAgent,
            Registerer,
            Inviter
        },

        mounted() {
            this.getAudioElement();

            this.UserAgentOptions.uri = UserAgent.makeURI(this.UserAgentOptions.aor);

            this.ua = new UserAgent(this.UserAgentOptions);
            this.rg = new Registerer(this.ua, this.UserAgentOptions.RegistererOptions);

            this.remoteStream = new MediaStream();

            setInterval(() => {
                
            }, 1000);

            // ###

            if(this.SipJSOptions.autoregister){
                
                this.ua.start().then(() => {
                    this.rg.register()
                });
            } else {

                this.ua.start()
            }

            this.ua.delegate.onConnect = () => {
                console.warn("Conectado!");

                this.wsConn = true;
            }

            this.ua.delegate.onDisconnect = () => {
                console.warn("Desconectado!");

                this.wsConn = false;
            }

            this.ua.delegate.onInvite = (invitation) => {
                console.warn("Invite!");
                this.incoming = invitation;
                this.onInvite();
            }
        }, 

        methods: {
            
            getAudioElement: function(){

                const el = document.getElementById(this.AudioElementId);

                if(!(el instanceof HTMLAudioElement)){

                    throw new Error(`Elemento ${this.AudioElementId} não encontrado ou não é um elemento de áudio!`)
                }

                this.AudioElement = el;
            }, 

            registerUserAgent: function(){

                this.rg.register();
            },

            unregisterUserAgent: function(){

                this.rg.unregister();
            },

            onInvite: function(){

                // Auto-Answer .. 
                // console.warn(this.invitation.incomingInviteRequest.message.headers['Call-Info'][0].raw);

                this.incoming.stateChange.addListener((state = SessionState) => {
                    console.log(`Session state changed to ${state}`);

                    switch (state) {
                    case SessionState.Initial:
                        break;
                    case SessionState.Establishing:
                        break;
                    case SessionState.Established:
                        this.setupRemoteMediaIn();
                        break;
                    case SessionState.Terminating:
                        // fall through
                    case SessionState.Terminated:
                        this.cleanupMedia();
                        break;
                    default:
                        throw new Error("Unknown session state.");
                    }
                });
            },

            acceptCall: function(){
                
                this.session = this.incoming.accept();
            },

            rejectCall(){

                this.incoming.reject();
                this.cleanupCall()
            },

            hangupCall(){

                // this.outgoing.bye();
                this.session.bye();
                this.cleanupCall()
            },

            cancelCall(){

                this.outgoing.cancel();
                this.cleanupCall()
            },

            makeCall: function(e){

                let number = e.target.value;

                let toCall = UserAgent.makeURI("sip:" + number + "@atenas.mxsolucoes.com.br:5060");

                this.outgoing = new Inviter(this.ua, toCall);

                this.outgoing.stateChange.addListener((state = SessionState) => {

                    console.warn(this.outgoing);

                    switch (state) {
                        case SessionState.Initial:
                            break;
                        case SessionState.Establishing:
                            break;
                        case SessionState.Established:
                            this.setupRemoteMediaOut(); 
                            break;
                        case SessionState.Terminating:
                            // fall through
                        case SessionState.Terminated:
                            this.cleanupMedia();
                            break;
                        default:
                            throw new Error("Unknown session state.");
                    }
                });

                this.outgoing.invite();
            }, 

            setupRemoteMediaOut: function(){

                this.outgoing.sessionDescriptionHandler.peerConnection.getReceivers().forEach((receiver) => {
                    
                    if (receiver.track) {
                        this.remoteStream.addTrack(receiver.track);
                    }
                });
            
                this.AudioElement.srcObject = this.remoteStream;
                this.AudioElement.play();
            },

            setupRemoteMediaIn: function(){

                this.incoming.sessionDescriptionHandler.peerConnection.getReceivers().forEach((receiver) => {
                    
                    if (receiver.track) {
                        this.remoteStream.addTrack(receiver.track);
                    }
                });
            
                this.AudioElement.srcObject = this.remoteStream;
                this.AudioElement.play();
            },

            cleanupMedia: function(){

                this.AudioElement.srcObject = null;
                this.AudioElement.pause();
            },

            cleanupCall: function(){

                this.outgoing = null;
                this.incoming = null;
            }
        }, 

        updated() {

            console.warn("Updated!");
        
            if(this.rg.state == "Registered"){
                
                this.$store.commit('setTrue');
            } else { 
                
                this.$store.commit('setFalse');
            }
        }
    }
</script>
