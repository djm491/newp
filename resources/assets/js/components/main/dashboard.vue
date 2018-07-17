<template>
    <div id="root">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Servers</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-de mb-0">
                            <thead>
                            <tr>
                                <th>Server Name</th>
                                <th>Online Users</th>
                                <th>Open Connections</th>
                                <th>Uptime</th>
                                <th>RAM</th>
                                <th>CPU</th>
                                <th>NETWORK</th>
                                <th>Live</th>
                                <th>Output</th>
                                <th>Input</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="server in servers">
                                <td>{{server.server_name}}</td>
                                <td>{{server.online_users}}</td>
                                <td>{{server.open_connections}}</td>
                                <td>{{server.uptime}}</td>
                                <td>
                                    <span>{{roundFunction(server.ram_used_percent)}}%</span>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" :style="{'width': server.ram_used_percent + '%'}"
                                             aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{roundFunction(server.cpu_usage)}}%</span>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" :style="{'width': server.cpu_usage + '%'}"
                                             aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{server.network}}%</span>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" :style="{'width': server.network + '%'}"
                                             aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">{{server.live_streaming}}</td>
                                <td class="text-truncate">{{server.output}}</td>
                                <td class="text-truncate">{{server.input}}</td>

                            </tr>
                            </tbody>
                        </table>
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
               servers:[]
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

</style>