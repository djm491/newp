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
                                    <i class="icon-call-in danger font-large-2 float-right"></i>
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
                                    <h6 class="text-muted">Order Value </h6>
                                    <h3>$ 88,568</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-trophy success font-large-2 float-right"></i>
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
                                    <h6 class="text-muted">Calls</h6>
                                    <h3>3,568</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-call-in danger font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4" v-for="server in servers">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{server.server_name}}</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body p-0">
                            <p class="text-bold-600">Online Users<span class="float-right">{{server.online_users}}</span></p>
                            <p class="text-bold-600">Open Connections<span class="float-right">{{server.open_connections}}</span></p>
                            <p class="text-bold-600">UpTime<span class="float-right">{{server.uptime}}</span></p>
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
                            <p class="text-bold-600"> Live
                                <span class="float-right">{{server.live_streaming}}</span>
                            </p>
                            <p class="text-bold-600">Output
                                <span class="float-right">{{server.output}}</span>
                            </p>
                            <p class="text-bold-600">Input
                                <span class="float-right">{{server.input}}</span>
                            </p>
                        </div>
                    </div>
                </div>
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
               openConnection: 0
            }
        },
        created() {
            this.getServers();
            setInterval(function () {
                this.getServers();
            }.bind(this), 10000);
        },
        methods: {
            getServers(){
                axios.get('/get-servers', {
                }).then((response) => {
                     const self = this;
                     self.servers = response.data;
                     for(let i=0;i<self.servers.length;i++) {
                         self.onlineUsers += self.servers[i].online_users;
                         self.openConnection += self.servers[i].open_connections;
                     }
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
</style>