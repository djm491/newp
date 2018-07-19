<template>
    <div id="root">
        <div class="row">
            <div class="col-lg-3 col-3">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted">Online User </h6>
                                    <h3>{{onlineUsers}}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-user success font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-3">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted">Open Connection</h6>
                                    <h3>{{openConnection}}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-globe danger font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted mb-16">Total OutPut (Mbps) <span class="float-right">{{total_output}}</span></h6>
                                    <h6 class="text-muted">Total Input (Mbps) <span class="float-right">{{total_input}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="text-muted mb-16">Online Streams <span class="float-right">{{online_streams}}</span></h6>
                                    <h6 class="text-muted">Offline Streams <span class="float-right">{{offline_streams}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 col-md-4" v-for="(server,index) in servers">
                <div class="card" :id="'exPopover1-'+index" variant="primary">
                    <div class="card-header">
                        <h4 class="card-title">{{server.server_name}}</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body p-0">
                            <p class="text-bold-600">Online Users<span class="float-right">{{server.online_users}}</span></p>
                            <p class="text-bold-600">Open Connections<span class="float-right">{{server.open_connections}}</span></p>
                            <p class="text-bold-600">UpTime<span class="float-right">{{server.uptime}}</span></p>

                            <p class="text-bold-600"> Live
                                <span class="float-right">{{server.live_streaming}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <b-popover :target="'exPopover1-'+index"
                           :placement="'left'"
                           triggers="hover focus">
                    <template>
                        <p class="text-bold-600">Output
                            <span class="float-right">{{server.output}}</span>
                        </p>
                        <p class="text-bold-600">Input
                            <span class="float-right">{{server.input}}</span>
                        </p>
                        <p class="text-bold-600">RAM
                            <span class="progress progress-sm  mb-1 box-shadow-2 float-right">
                                    <span class="progress-bar bg-gradient-x-warning" role="progressbar" :style="{'width': server.ram_used_percent + '%'}"
                                          aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                    </span>
                              </span>
                            <span class="float-right">{{roundFunction(server.ram_used_percent)}}%</span>
                        </p>
                        <p class="text-bold-600">CPU
                            <span class="progress progress-sm  mb-1 box-shadow-2 float-right">
                                    <span class="progress-bar bg-gradient-x-success" role="progressbar" :style="{'width': server.cpu_usage + '%'}"
                                          aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                    </span>
                             </span>
                            <span class="float-right">{{roundFunction(server.cpu_usage)}}%</span>
                        </p>
                        <p class="text-bold-600">NETWORK
                            <span class="progress progress-sm  mb-1 box-shadow-2 float-right">
                                     <span class="progress-bar bg-gradient-x-danger" role="progressbar" :style="{'width': server.network + '%'}"
                                           aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                    </span>
                             </span>
                            <span class="float-right">{{roundFunction(server.network)}}%</span>
                        </p>
                    </template>
                </b-popover>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
               servers:[],
               onlineUsers:0,
               openConnection: 0,
               online_streams:0,
               offline_streams:0,
               total_output: 0,
               total_input: 0
            }
        },
        created() {
            this.getServers();
            setInterval(function () {
                this.getServers();
            }.bind(this), 150000);
        },
        methods: {
            getServers(){
                axios.get('/get-servers', {
                }).then((response) => {
                     const self = this;
                     self.servers = response.data.servers;
                     self.onlineUsers = response.data.total_online_users;
                     self.openConnection = response.data.total_open_connection;
                     self.online_streams = response.data.onlineStreams;
                     self.offline_streams = response.data.offlineStreams;
                     self.total_input = response.data.totalInput;
                     self.total_output = response.data.totalOutput;
                });
            },
            calcBar(data){
                return data*10
            },
            roundFunction(data){
                return Math.round(data);
            }
        }
    }
</script>
<style scoped>
    .card-body p{
        padding: 0px 5px 2px 5px;
        border-bottom: 1px solid #E3EBF3;
    }
   .card-body p span{
       font-weight: normal !important;
    }
    .progress {
       width: 65px;
       margin: 0.4rem 0 0 20px !important;
    }
    .mb-16{
        margin-bottom: 16px;
    }
</style>